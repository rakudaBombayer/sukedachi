<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function index(Request $request, $chatRoomId)
    {
    // 🔹 指定されたチャットルームのメッセージを取得
        $chatMessages = ChatMessage::where('chat_room_ID', $chatRoomId)->latest()->get();

        return view('chat_messages.index', compact('chatMessages', 'chatRoomId'));
    }

    public function create()
    {
        return view('chat_messages.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $request->validate([
        'chat_room_ID' => 'required|integer|exists:chat_rooms,chat_room_ID',
        'text' => 'required|string|max:500',
        ]);

        ChatMessage::create([
            'chat_room_ID' => $request->input('chat_room_ID'),
            'user_ID' => Auth::id(),// ログインしているユーザーのIDを取得
            'text' => $request->input('text'),
        ]);

        // return back()->with('success', 'メッセージを送信しました');
        // return redirect()->route('chat_rooms.index', $request->chat_room_ID)->with('success', 'メッセージを送信しました');

        return redirect()->route('chat_rooms.show', ['chatRoom' => $request->input('chat_room_ID')])
                 ->with('success', 'メッセージを送信しました');
    }

    public function show(ChatMessage $chatMessage)
    {
        // return view('chat_messages.show', compact('chatMessage'));
        // return redirect()->route('chat_rooms.show', $chatRoomId);
        // return redirect()->route('chat_rooms.show', $request->input('chat_room_ID'));

        // 送信後に正しいチャットルームに戻る
        return redirect()->route('chat_rooms.show', $request->input('chat_room_ID'))
                 ->with('success', 'メッセージを送信しました');
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
