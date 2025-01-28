<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        return view('chat_rooms.index', compact('chatRooms'));
    }

    public function create()
    {
        return view('chat_rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_ID' => 'required|exists:users,user_ID',
        ]);

        ChatRoom::create($request->all());
        return redirect()->route('chat_rooms.index');
    }

    public function show(ChatRoom $chatRoom)
    {
        return view('chat_rooms.show', compact('chatRoom'));
    }

    public function edit(ChatRoom $chatRoom)
    {
        return view('chat_rooms.edit', compact('chatRoom'));
    }

    public function update(Request $request, ChatRoom $chatRoom)
    {
        $request->validate([
            'user_ID' => 'required|exists:users,user_ID',
        ]);

        $chatRoom->update($request->all());
        return redirect()->route('chat_rooms.index');
    }

    public function destroy(ChatRoom $chatRoom)
    {
        $chatRoom->delete();
        return redirect()->route('chat_rooms.index');
    }
}