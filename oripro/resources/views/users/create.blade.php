@extends('layouts.app')

@section('content')
    <h1>アカウント作成画面</h1>
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
@endsection
