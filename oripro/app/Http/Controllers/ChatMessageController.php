<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

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

        // $data['user_ID'] = 1; // ← 一時的にユーザーIDをハードコード (例: 1)
        
        ChatMessage::create([
            'chat_room_ID' => $request->input('chat_room_ID'),
            'user_ID' => 1, // ログインしているユーザーのIDを取得
            'text' => $request->input('text'),
        ]);
        
        return back(); // 直前のページへリダイレクト
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