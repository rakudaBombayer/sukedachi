@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>スケダチ</title>
</head>
<body>

    <img
  class="fit-picture"
  src="{{ asset('images/hand_kari.png') }}"
  alt="手の仮画像" />

    <h1></h1>
    <p>これは閲覧画面画面</p>
    <nav>
        <ul>
            <li><a href="{{ route('requests.create') }}" style="color: red;">手伝って</a></li>


            @auth
                <p>ようこそ、{{ Auth::user()->nickname }} さん！</p>
                    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
                </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>

            @else
                <p>ログインしていません。</p>
                <a href="{{ route('login') }}">ログイン</a>
            @endauth
        </ul>
    </nav>

    <div>
        <h2>投稿された依頼</h2>
        <div class="max-w-5xl mx-auto px-4">
            @if (isset($allRequests) && count($allRequests) > 0)
            {{-- <div class="max-w-5xl mx-auto px-4"> --}}
            {{-- < class="grid grid-cols-1 md:grid-cols-2 gap-4"> --}}

            {{-- ↓仮 --}}
            <div class="flex flex-wrap gap-4">
            @foreach ($allRequests as $request)
                
                    <div class="w-[30%] min-w-[200px] bg-white shadow rounded-md p-4 hover:bg-gray-50 transition">
                        <a href="{{ route('requests.show', $request->request_ID) }}" class="font-semibold text-blue-600 hover:underline block">
                            {{ $request->title }}
                        </a>
                        <p class="text-sm text-gray-600 mt-1">場所 {{ $request->general_area }}</p>
                    </div>
                            
            @endforeach
            </div>


                <p>{{ count($allRequests) }} 件の投稿</p>
                <div class="grid grid-cols-2 gap-4">
                <div class="bg-yellow-200 p-4">カード1</div>
                <div class="bg-yellow-200 p-4">カード2</div>
                <div class="bg-yellow-200 p-4">カード3</div>
                <div class="bg-red-300 p-4">A</div>
                </div>


            
            <div class="grid grid-cols-2 gap-4 bg-yellow-200 p-4">
                <div class="bg-red-500 p-4">A</div>
                <div class="bg-blue-500 p-4">B</div>
            </div>
        @else
            <p>まだ投稿された依頼はありません。</p>
        @endif
        </div>


    </div>
@endsection