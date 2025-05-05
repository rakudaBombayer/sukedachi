@extends('layouts.app')

@section('content')
    <h1>依頼投稿画面</h1>
    {{-- <form method="POST" action="{{ route('users.store') }}"> --}}
    <form method="POST" action="{{ route('requests.store') }}">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" required>
        </div>
    
        <div>
            <label for="help_type">お手伝い種類</label>
            <input type="text" id="help_type" name="help_name" required>
        </div>
    
        <div>
            <label for="help_details">お手伝い詳細</label>
            <input type="text" id="help_details" name="help_details" required style="width: 300px; height: 80px;">
        </div>
    
        <div>
            <label for="requested_date">希望日、希望時間</label>
            <input type="datetime-local"" id="requested_date" name="requested_date" required>
        </div>
    
        <div>
            <label for="image">お手伝い画像</label>
            <input type="file" id="image" name="image">
            <input type="file" id="image2" name="image">
            <input type="file" id="image3" name="image">
            <input type="file" id="image4" name="image">
            <small>JPEG、PNG、GIF形式のファイルを選択してください。</small>
        </div>
    
        <div>
            <label for="estimated_time">所要時間</label>
            <input type="text" id="estimated_time" name="estimated_time" required>
        </div>
    
        <div>
            <label for="location">大まかな場所</label>
            <input type="text" id="location" name="general_area" required>
        </div>
    
    
        <button type="submit">投稿</a></button>
    </form>
    <button><a href="{{ url()->previous() }}">戻る</a></button>
@endsection