@extends('layouts.app')

@section('content')
    <h1>投稿できました。応募があるまでお待ちください。</h1>
    <button><a href="{{ route('index') }}" style="color: red;">ホームへ</a></button>
@endsection