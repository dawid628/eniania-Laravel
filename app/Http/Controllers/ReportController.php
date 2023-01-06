<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        return view('/panel/reports', ['reports' => $reports]);
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
        $report = new Report();
        $report->user_id = $request->user_id;
        $report->title = $request->title;
        $report->message = $request->message;
        if($report->save()){
            $message = "Pomyślnie wysłano zgłoszenie.";
            return view('contact', ['message' => $message]);
        }
        $error = "Nie udało się wysłać zgłoszenia.";
        return view('contact', ['message' => $error]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::find($id);
        if(!$report==null){
            return view('/contacts/show', ['report' => $report]);
        }
    }

    public function confirm($id)
    {
        $report = Report::find($id);
        $report->status = 1;
        if($report->save()){
            return redirect()->route('reports')->with('message', 'Pomyślnie zmieniono status zgłoszenia.');
        }
        return redirect()->route('reports')->with('error', 'Nie udało się zmienić statusu zamówienia.');
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
