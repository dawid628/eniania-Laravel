<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Answer;
use App\Models\Report;

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
        Mail::to($email)->send(new Answer($answer, $title));
        return redirect()->route('reports')->with('message', 'Wysłano odpowiedź.');
    }
}
