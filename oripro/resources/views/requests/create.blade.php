@extends('layouts.app')

@section('content')
    <h1>依頼投稿画面</h1>
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Create</button>
    </form>
    <button styled=><a href="{{ route('requests.complete') }}" style="color: red;">投稿</a></button>
    <button styled=>投稿</button>
@endsection