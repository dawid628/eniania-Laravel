<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Message;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $messages = Message::all();
        
        foreach($messages as $message){
            if(!($message->from_id == Auth::id() || $message->to_id == Auth::id())){
                $messages->unset($message);
            }
            else{
                $message->seen = true;
                $message->save();
            }
        }

        if($messages->count() > 0){
            $chats = array();
            foreach($messages as $message){
                if(!(in_array($message->from_id, $chats))){
                    if($message->from_id != Auth::id()){
                       array_push($chats, $message->from_id); 
                    }
                    
                }
                if(!(in_array($message->to_id, $chats))){
                    if($message->to_id != Auth::id()){
                        array_push($chats, $message->to_id);
                    }
                    
                }
            }
            return view('/messages/chat', ['id' => $id, 'messages' => $messages, 'chats' => $chats]);
        }
            return view('/messages/chat', ['id' => $id, 'messages' => $messages]);
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
        $message = new Message();
        $message->from_id = Auth::id();
        $message->to_id = $request->to_id;
        $message->body = $request->message;
        if($message->save()){
            return redirect()->route('chat', ['id' => $request->to_id]);
        }
        return false;
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
