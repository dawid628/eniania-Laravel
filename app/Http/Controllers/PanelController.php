<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PanelController extends Controller
{
    public function index()
    {
        $users =  User::with('roles')->whereHas('roles')->get();
        
        return view('panel', ['users' => $users]);
    }
}
