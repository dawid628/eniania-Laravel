<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Babysitter;
use App\Http\Controllers\HttpException;

class BabysitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user_id = $request->user()->id;
        $babysitter = Babysitter::all()->where('user_id', $user_id);
        if($babysitter != null){
            // uzytkownik posiada juz profil niani
            return 0;
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
        if(!$request->hasFile('image')){return 0;}
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/images' ;
        $file->move($destinationPath, $fileName);
        $profile->photo_name = $fileName; 

        if(!($profile->save())) {
            throw new HttpException(500, "Something went wrong!");
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
        //
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
