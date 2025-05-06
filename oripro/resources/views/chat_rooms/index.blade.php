@extends('layouts.app')

@section('content')
    <h1>スケダチ</h1>
    <div>ちゃっとるーむへようこそ</div>
    <button><a href="{{ url()->previous() }}">戻る</a></button>
@endsection
