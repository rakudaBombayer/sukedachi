@extends('layouts.app')

@section('content')
    <h1>投稿できました。応募があるまでお待ちください。</h1>

    <h2>投稿内容</h2>
    <ul>
        <li>タイトル: {{ $request->title }}</li>
        <li>お手伝い種類: {{ $request->help_name }}</li>
        <li>お手伝い詳細: {{ $request->help_details }}</li>
        <li>希望日、希望時間: {{ $request->requested_date }}</li>
        @if ($request->image_path)
            <li>画像1: <img src="{{ asset('storage/' . str_replace('public/', '', $request->image_path)) }}" alt="投稿画像1" style="max-width: 200px;"></li>
        @endif
        @if ($request->image_path2)
            <li>画像2: <img src="{{ asset('storage/' . str_replace('public/', '', $request->image_path2)) }}" alt="投稿画像2" style="max-width: 200px;"></li>
        @endif
        @if ($request->image_path3)
            <li>画像3: <img src="{{ asset('storage/' . str_replace('public/', '', $request->image_path3)) }}" alt="投稿画像3" style="max-width: 200px;"></li>
        @endif
        @if ($request->image_path4)
            <li>画像4: <img src="{{ asset('storage/' . str_replace('public/', '', $request->image_path4)) }}" alt="投稿画像4" style="max-width: 200px;"></li>
        @endif
        <li>所要時間: {{ $request->estimated_time }}</li>
        <li>大まかな場所: {{ $request->general_area }}</li>
        {{-- <li>募集期限: {{ $request->deadline }}</li> --}}
        <li>投稿日時: {{ $request->created_at }}</li>
    </ul>

    <button><a href="{{ route('index') }}" style="color: red;">ホームへ</a></button>

@endsection