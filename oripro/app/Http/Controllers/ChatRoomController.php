<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage; 
use App\Models\Request as UserRequest; // 正しい名前空間で use
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function index(Request $request)
    {
        $chatRooms = ChatRoom::all();
        $previousRequestId = Session::get('previous_request_id', null);
        
        // 🔹 chatRoomId を明示的に定義！
        $chatRoomId = $request->query('chat_room_ID', $chatRooms->first()->chat_room_ID ?? null);
        // $previousRequestId = Session::get('previous_request_id', null);
        $chatRoom = $chatRooms->first();
        
        // $chatRoomId = $request->query('chat_room_ID', $chatRooms->first()->chat_room_ID ?? null); 

          if (!$chatRoom) {
            return redirect()->back()->with('error', 'チャットルームが存在しません');
        }

        // $chatMessages = ChatMessage::where('chat_room_ID', $chatRoomId)->latest()->get();
        $chatMessages = ChatMessage::where('chat_room_ID', $chatRoom->chat_room_ID)->latest()->get();
        // $chatMessages = $chatRooms->isNotEmpty()
        // ? ChatMessage::whereIn('chat_room_ID', $chatRooms->pluck('chat_room_ID'))->get()
        // : collect();
        
        return view('chat_rooms.index', compact('chatRooms', 'previousRequestId', 'chatMessages', 'chatRoom', 'chatRoomId'));
        // return view('chat_rooms.index', compact('chatRooms', 'previousRequestId', 'chatMessages', 'chatRoomId'));
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
    

    public function goto($requestId)
{
    // 例: チャットルームがあれば表示、なければ作るなど
    $chatRoom = ChatRoom::where('request_ID', $requestId)
                        ->where('user_ID', Auth::id())
                        ->first();

    if (!$chatRoom) {
        $chatRoom = ChatRoom::create([
            'request_ID' => $requestId,
            'user_ID' => Auth::id(),
            'isOpen' => true,
        ]);
    }

    return redirect()->route('chat_rooms.show', $chatRoom->chat_room_ID);
}




    


    public function gotoChat(Request $request)
    {   

        $request->validate([
        'request_ID' => 'required|integer|exists:requests,request_ID',
        ]);
        
        $requestId = intval($request->input('request_ID'));
        
        $userRequest = UserRequest::findOrFail($requestId);


        
        if (Auth::id() === $userRequest->user_ID) {
            return back()->with('error', '自分自身の投稿にはチャットできません。');
        }
        
         // 既存のチャットルームがある場合はそれを再利用
        $existingRoom = ChatRoom::where('request_ID', $requestId)
                            ->where('user_ID', Auth::id())
                            ->first();
        
            if ($existingRoom) {
            return redirect()->route('chat_rooms.show', $existingRoom->chat_room_ID);
            }

            // dd($requestId, gettype($requestId));
                // 新しいチャットルームを作成
            
            // $chatRoom = ChatRoom::create([
            // 'request_ID' => $requestId,
            // 'user_ID' => Auth::id(),
            // 'isOpen' => true,
            // ]);
            // dd($chatRoom);


             // 🔹 **新しいチャットルームのデータをデバッグ**
            $chatRoomData = [
                'request_ID' => $requestId,
                'user_ID' => Auth::id(),
                'isOpen' => true,
            ];
            // dd($chatRoomData);
            // dd(ChatRoom::create($chatRoomData));

            // 🔹 **新しいチャットルームを作成**
            $chatRoom = ChatRoom::create($chatRoomData);
            
            
                            
        // 直前に表示していた依頼のIDをセッションに保存
        // Session::put('previous_request_id', $request->request);
        Session::put('previous_request_id', $requestId);
        
        // dd(Session::get('previous_request_id')); 

        // チャットルーム一覧画面へリダイレクト
        // return redirect()->route('chat_rooms.index');
        
        return redirect()->route('chat_rooms.show', $chatRoom->chat_room_ID)
                     ->with('success', 'チャットルームを作成しました');
        
    }
    
    
    public function show(ChatRoom $chatRoom)
    {   
        $chatMessages = ChatMessage::where('chat_room_ID', $chatRoom->chat_room_ID)->get();

        $chatRoomId = $chatRoom->chat_room_ID;
        
        return view('chat_rooms.index', compact('chatRoom', 'chatMessages', 'chatRoomId'));
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


    public function createChatRoom(Request $request, $requestId)
    {
        $userRequest = UserRequest::findOrFail($requestId);

        // 投稿者はチャットルームを作らない
        if (Auth::id() === $userRequest->user_ID) {
            return redirect()->back()->with('error', '投稿者はチャットルームを作成できません。');
        }

        // **この手伝いユーザー用のチャットルームがあるか**チェック
        $existingRoom = ChatRoom::where('request_ID', $requestId)
                            ->where('user_ID', Auth::id())
                            ->first();

        if ($existingRoom) {
            return redirect()->route('chat_rooms.show', $existingRoom->chat_room_ID);
        }

        // **新しい手伝いユーザー用のチャットルームを作成**
        $chatRoom = ChatRoom::create([
            'request_ID' => $requestId,
            'user_ID' => Auth::id(),
        ]);

        return redirect()->route('chat_rooms.show', $chatRoom->chat_room_ID);
}




    
}