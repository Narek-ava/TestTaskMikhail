<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $message =  new Message();
       $message->user_id = $request->id;
       $message->theme = 'Тема сообщения';
       $message->text = 'Текст сообщения Текст сообщения Текст сообщения Текст
сообщения Текст сообщения';
       $message->status = 'unread';
       $message->save();

       return $message;
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function latestMessage(Request $request)
    {
        return Message::query()->where('user_id', $request->id)->get();
    }

    public function markAsRead(Request $request)
    {
        $message = Message::where('id', $request->id)->first(); // Retrieve the message by its ID

        if ($message) {
            $message->update([
                'status' => 'read' // Update the 'status' column to 'read'
            ]);
        }
            return $message;
    }
}
