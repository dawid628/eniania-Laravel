<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Babysitter;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Auth;

class BabysitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $babysitters = Babysitter::all();
        return view('/babysitter/index', ['babysitters' => $babysitters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->fresh();
        $user_id = Auth::id();
        $babysitter = Babysitter::where('user_id', $user_id)->first();
        if(!$babysitter == null){
            // uzytkownik posiada juz profil niani
            $problem = "Posiadasz już profil niani.";
            return view('/babysitter/create', ['problem' => $problem]);
        }
        $profile = new Babysitter();
        $profile->first_name = $request->first_name;
        $profile->second_name = $request->second_name;
        $profile->phone_number = $request->phone_number;
        $profile->city = $request->city;
        $profile->description = $request->description;
        $profile->minimum_age = $request-> minimum_age;
        $profile->maximum_age = $request-> maximum_age;
        $profile->price = $request->price;
        $profile->user_id = $user_id;
        // photo
        if(!$request->hasFile('image')){
            $problem = "Zdjęcie nie spełnia warunków serwisu.";
            return view('/babysitter/create', ['problem' => $problem]);
        }
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/images';
        $file->move($destinationPath, $fileName);
        $profile->photo_name = $fileName; 

        if(!($profile->save())) {
            $problem = "Coś poszło nie tak.";
            return view('/babysitter/create', ['problem' => $problem]);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
