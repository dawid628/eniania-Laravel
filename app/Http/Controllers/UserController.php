<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Models\RoleToUser;
use App\Models\Role;
use App\Models\Reply;
use App\Models\Report;
use App\Models\Opinion;
use App\Models\Message;
use App\Models\Babysitter;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete($id)
    {
        if(User::find($id))
        {
            $babysitter = Babysitter::where('user_id', $id)->first();
            if($babysitter != null)
            {
                $opinions = Opinion::all()->where('babysitter_id', '=', $babysitter->id);
                foreach($opinions as $opinion)
                {
                    $opinion->delete();
                }
                $babysitter->delete();
            }
            DB::table("role_user")->where("user_id", $id)->delete();

            $opinions = Opinion::all()->where('author_id', '=', $id);
            if($opinions != null){
                foreach($opinions as $opinion)
                {
                    $opinion->delete();
                }
            }
            $messages = Message::all()->where('from_id', '=', $id);
            if(count($messages) > 0)
            {
                foreach($messages as $message)
                {
                    $message->delete();
                }
            }
            $messages = Message::all()->where('to_id', '=', $id);
            if(count($messages) > 0)
            {
                foreach($messages as $message)
                {
                    $message->delete();
                }
            }
            $reports = Report::all()->where('user_id', '=', $id);
            if(count($reports) > 0)
            {
                foreach($reports as $report)
                {
                    $replies = Reply::all()->where('report_id', '=', $report->id);
                    foreach($replies as $reply)
                    {
                        $reply->delete();
                    }
                    $report->delete();
                }
            }
            if(User::find($id)){
                User::find($id)->delete();
            }
            
            return redirect()->back()->with('message', 'Użytkownik został usunięty.');
        }
        if(!User::find($id))
            return "Usuwanie nie powiodło się.";

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
