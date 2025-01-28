@extends('layouts.app')

@section('content')
    <h1>Chat Rooms</h1>
    <ul>
        @foreach ($chatRooms as $chatRoom)
            <li>{{ $chatRoom->id }} - {{ $chatRoom->name }}</li>
        @endforeach
    </ul>
    <a href="{{ route('chat_rooms.create') }}">Create New Chat Room</a>
@endsection
