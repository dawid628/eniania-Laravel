<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\Answer;
use App\Models\Report;
use App\Models\Reply;

class MailController extends Controller
{
    public function sendMail(Request $request) 
    { 
        // email title answer
        $email = $request->email;
        $title = $request->title;
        $answer = $request->answer;
        $report = Report::find($request->report_id);
        $report->status = 1;
        $report->save();

        // save reply to db
        $reply = new Reply();
        $reply->author = Auth::user()->name;
        $reply->message = $answer;
        $reply->report_id = $report->id;
        $reply->save();

        Mail::to($email)->send(new Answer($answer, $title));
        return redirect()->route('reports')->with('message', 'Wysłano odpowiedź.');
    }
}
