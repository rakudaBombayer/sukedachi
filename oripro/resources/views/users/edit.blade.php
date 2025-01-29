@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button type="submit">Update</button>
    </form>
@endsection
