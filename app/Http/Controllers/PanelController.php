<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleToUser;

class PanelController extends Controller
{
    public function index()
    {
        $users =  User::with('roles')->whereHas('roles')->get();
        return view('/panel/users', ['users' => $users]);
    }

    public function makeModerator($user_id){
        $role = Role::where('name', 'moderator')->first();
        $role_user = RoleToUser::where('user_id', $user_id)->first();
        $role_user->role_id = $role->id;
        if($role_user->save()){
            $message = "Nadano uprawnienia moderatora.";
            return redirect()->route('panel')->with('message', $message);
        }
        $error = "Nie udało się nadać uprawnień.";
        return redirect()->route('panel')->with('error', $error);
    }

    public function makeUser($user_id){
        $role = Role::where('name', 'user')->first();
        $role_user = RoleToUser::where('user_id', $user_id)->first();
        $role_user->role_id = $role->id;
        if($role_user->save()){
            $message = "Zabrano uprawnienia moderatora.";
            return redirect()->route('panel')->with('message', $message);
        }
        $error = "Nie udało się zabrać uprawnień.";
        return redirect()->route('panel')->with('error', $error);
    }
}
