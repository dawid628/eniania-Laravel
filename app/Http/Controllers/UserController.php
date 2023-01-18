<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Models\RoleToUser;
use App\Models\Role;
use App\Models\Babysitter;
use Auth;

class UserController extends Controller
{
    public function delete($id)
    {
        if(User::find($id)){
            $babysitter = Babysitter::where('user_id', $id)->first();
            if($babysitter != null){
                $babysitter->delete();
            }
        DB::table("role_user")->where("user_id", $id)->delete();
        DB::table("users")->where("id", $id)->delete();

        return redirect()->back()->with('message', 'User deleted succesfully.');
        }

        if(!User::find($id))
            return "User doesn't exists.";

    }

    public function getRole($id){
        $roleId = RoleToUser::where('user_id', $id)->first();
        $role = Role::where('id', $roleId->id)->pluck('name')->first();
        return $role; 
    }  
    
    public function show()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user != null){
            $user->name = $request->name;
            $user->email = $request->email;
            if($user->save()){
                $message = "Pomyślnie zaktualizowano profil.";
                return view('profile', ['message' => $message, 'user' => $user]);
            }
        }
        $error = "Coś poszło nie tak.";
        return view('profile', ['error' => $error, 'user' => $user]);
    }
}
