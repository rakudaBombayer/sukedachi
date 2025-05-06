<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Request as UserRequest; // 正しい名前空間で use
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function index()
    {
        $chatRooms = ChatRoom::all();
        $previousRequestId = Session::get('previous_request_id'); // セッションから前の依頼IDを取得
        
        return view('chat_rooms.index', compact('chatRooms', 'previousRequestId'));
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


    public function gotoChat(Request $request)
    {
        // 直前に表示していた依頼のIDをセッションに保存
        Session::put('previous_request_id', $request->request);


        // チャットルーム一覧画面へリダイレクト
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