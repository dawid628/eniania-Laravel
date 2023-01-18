<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Babysitter;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Str;
use Auth;
use Intervention\Image\Facades\Image;

class BabysitterController extends Controller
{

    private function getQuery(Request $request){
        
        return Babysitter::paginate(5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $babysitters = $this->getQuery($request);

        if(isset($request->city))
        {
            $babysitters = $babysitters->where('city', '=', $request->city);
        }
        if(isset($request->price_min))
        {
            $babysitters = $babysitters->where('price', '>=', $request->price_min);
        }
        if(isset($request->price_max))
        {
            $babysitters = $babysitters->where('price', '<=', $request->price_max);
        }
        if(isset($request->age))
        {
            $babysitters = $babysitters->where('minimum_age', '<=', $request->age)->where('maximum_age', '>=', $request->age);
        }
        if($babysitters->count() > 0)
        {
            $cities = Babysitter::Select('city')->groupBy('city')->get();
            return view('/babysitter/index', ['babysitters' => $babysitters, 'cities' => $cities]);
        }
        return view('/babysitter/index', ['babysitters' => $babysitters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/babysitter/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/', $filename);
            $resizedImage = Image::make('images/'.$filename)->fit(400, 400)->save();
         }
        Auth::user()->fresh();
        $user_id = Auth::id();
        $babysitter = Babysitter::where('user_id', $user_id)->first();
        if(!$babysitter == null){
            // uzytkownik posiada juz profil niani
            $problem = "Posiadasz już profil niani.";
            return view('/babysitter/create', ['problem' => $problem]);
        }
        $profile = new Babysitter();
        $profile->first_name = Str::lower($request->first_name);
        $profile->second_name = Str::lower($request->second_name);
        $profile->phone_number = $request->phone_number;
        $profile->city = Str::lower($request->city);
        $profile->description = $request->description;
        $profile->minimum_age = $request-> minimum_age;
        $profile->maximum_age = $request-> maximum_age;
        $profile->price = $request->price;
        $profile->user_id = $user_id;

        $profile->photo_name = $filename;

        $profile->save();
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $babysitter = Babysitter::find($id);
        if(!$babysitter==null){
            return view('/babysitter/show', ['babysitter' => $babysitter]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $babysitter = Babysitter::find($id);
        return view('/babysitter/edit', ['babysitter' => $babysitter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $babysitter = Babysitter::find($request->id);
        $babysitter->first_name = $request->first_name;
        $babysitter->second_name = $request->second_name;
        $babysitter->phone_number = $request->phone_number;
        $babysitter->city = Str::lower($request->city);
        $babysitter->minimum_age = $request->minimum_age;
        $babysitter->maximum_age = $request->maximum_age;
        $babysitter->price = $request->price;
        $babysitter->description = $request->description;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('images/', $filename);
            $resizedImage = Image::make('images/'.$filename)->fit(400, 400)->save();
            $babysitter->photo_name = $filename;
        }

        if($babysitter->save()){
            $message = "Pomyślnie zaktualizowano profil.";
            return view('/babysitter/show', ['babysitter' => $babysitter, 'message' => $message]);
        }
        $error = "Coś poszło nie tak.";
        return view('/babysitter/show', ['babysitter' => $babysitter, 'error' => $error]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Babysitter::find($id)->delete()){
            $message = "Pomyślnie usunięto profil niani.";
            return redirect()->back()->with('message', $message);
        }
        $error = "Nie udało się usunąć profilu niani.";
        return redirect()->route('show-profile')->with('error', $error);
    }

    public function noConfirmed()
    {
        $babysitters = Babysitter::where('confirmed', 0)->paginate(5);
        return view('/panel/nonconfirmed', ['babysitters' => $babysitters]);
    }
    
    public function confirm($id)
    {
        $babysitter = Babysitter::find($id);
        if($babysitter == null){
            return redirect()->route('confirming')->with('error', 'Coś poszło nie tak.');
        }
        $babysitter->confirmed = 1;
        $babysitter->save();
        return redirect()->route('confirming')->with('message', 'Pomyślnie potwierdzono profil.');;
    }

    public function unConfirm($id)
    {
        $babysitter = Babysitter::find($id);
        if($babysitter == null){
            return redirect()->route('confirming')->with('error', 'Coś poszło nie tak.');
        }
        $babysitter->confirmed = 0;
        $babysitter->save();
        // return redirect()->route('confirming')->with('message', 'Pomyślnie potwierdzono profil.');
        return redirect()->back()->with('message', 'Pomyślnie wyłączono profil.');
    }
    public function showAll()
    {
        $babysitters = Babysitter::paginate(5);
        return view('panel/babysitters', ['babysitters' => $babysitters]);
    }
}
