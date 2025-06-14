<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatMessageController extends Controller
{
    public function index()
    {
        $chatMessages = ChatMessage::all();
        return view('chat_messages.index', compact('chatMessages'));
    }

    public function create()
    {
        return view('chat_messages.create');
    }

    public function store(Request $request)
    {

        $request->validate([
        'chat_room_ID' => 'required|exists:chat_rooms,chat_room_ID',
        'text' => 'required|string',
    ]);
        
        ChatMessage::create([
            'chat_room_ID' => $request->input('chat_room_ID'),
            'user_ID' => Auth::id(),// ログインしているユーザーのIDを取得
            'text' => $request->input('text'),
        ]);
        
        return back();
    }

    public function show(ChatMessage $chatMessage)
    {
        return view('chat_messages.show', compact('chatMessage'));
    }

    public function edit(ChatMessage $chatMessage)
    {
        return view('chat_messages.edit', compact('chatMessage'));
    }

    public function update(Request $request, ChatMessage $chatMessage)
    {
        $request->validate([
            'chat_room_ID' => 'required|exists:chat_rooms,chat_room_ID',
            'user_ID' => 'required|exists:users,user_ID',
            'text' => 'required|string',
        ]);

        $chatMessage->update($request->all());
        return redirect()->route('chat_messages.index');
    }

    public function destroy(ChatMessage $chatMessage)
    {
        $chatMessage->delete();
        return redirect()->route('chat_messages.index');
    }
}