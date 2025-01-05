<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chatRooms = ChatRoom::where('staff_id', \Auth::id())
            ->where('status','=', 1)
            ->with('messages', 'customer', 'staff')
            ->get();
        return view('admin.chats.index', compact('chatRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chatRoom = ChatRoom::where('id',$id)->with('messages', 'customer', 'staff')->first();
        $chatRooms = $chatRoom->where('staff_id', \Auth::id())->where('status','=', 1) ->with('messages', 'customer', 'staff')->get();
        return view('admin.chats.show', compact('chatRoom', 'chatRooms'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $chatRoom = ChatRoom::find($id);

        $message = Message::create([
            'chat_room_id' => $chatRoom->id,
            'sender_id' => \Auth::id(),
            'sender_name' => \Auth::user()->username,
            'message' => $request->message,
        ]);

        broadcast( new SendMessage($message, $chatRoom->customer_id))->toOthers();

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
