@extends('layouts.app')

@section('content')

<div class="flex flex-col pt-6 items-center min-h-screen text-center">
        @auth
                @if (Auth::id() !== $request->user_ID)
                    {{-- <form method="POST" action="{{ route('chat_rooms.goto', $request->request_ID) }}"> --}}
                        <form method="POST" action="{{ route('applicants.store') }}">
                            @csrf
                            <input type="hidden" name="request_ID" value="{{ $request->request_ID }}">
                            <input type="hidden" name="user_ID" value="{{ Auth::id() }}"> 
                            <button type="submit" class="bg-[#FF9D9D] text-xl font-bold text-white mt-8 py-2 px-4 rounded-3xl hover:bg-[#fd8f8f] transition shadow-md">手伝う</button>
                        </form>
                @endif
            @else
            <p><a href="{{ route('login') }}">ログインして応募する</a></p>
        @endauth

        <div class="mt-4">
            <strong>タイトル:</strong> {{ $request->title }}
        </div>

        <div>
            <strong>お手伝い種類:</strong> {{ $helpCategory }}
        </div>

        <div>
            <strong>お手伝い詳細↓</strong> <pre>{{ $request->help_details }}</pre>
        </div>
        <div>
            <strong>希望日時:</strong> {{ $request->requested_date }}
        </div>

            @if ($request->image)
                <div>
                    <strong>画像:</strong>
                    <img src="{{ asset($request->image->image) }}?v={{ time() }}" alt="依頼画像" loading="lazy" style="max-width: 300px;">
                </div>
            @endif

        <div>
            <strong>所要時間:</strong> {{ $request->estimated_time }}
        </div>

        <div>
            <strong>場所:</strong> {{ $request->general_area }}
        </div>

        




        {{-- ログインしている場合のみ表示 お試し↓ --}}
    @auth
        {{-- ログインユーザーが依頼の投稿者である場合のみ、編集・削除ボタンを表示 --}}
        @if (Auth::id() === $request->user_ID)
            <div style="margin-top: 20px;"><a href="{{ route('requests.select', $request->request_ID) }}" style="padding: 8px 15px; background-color: #fd8f8f; color: white; text-decoration: none; border-radius: 5px;">選定ページへ</a></div>

            <div style="margin-top: 20px;">
                {{-- 編集ボタン --}}
                <a href="{{ route('requests.edit', $request->request_ID) }}" style="padding: 8px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                    編集
                </a>

                {{-- 削除ボタン (フォームとして実装し、DELETEメソッドを偽装) --}}
                <form action="{{ route('requests.destroy', $request->request_ID) }}" method="POST" onsubmit="return confirm('本当にこの依頼を削除しますか？');" style="display:inline-block; margin-left: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding: 8px 15px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        削除
                    </button>
                </form>
            </div>
        @endif
    @endauth



            {{-- ↑ここに編集ボタンをお試し。 --}}

        {{-- <button><a href="{{ route('index') }}">ホームへ戻る</a></button> --}}
        <button onclick="window.location.href='{{ route('index') }}'" class="bg-[#FF9D9D] text-xl font-bold text-white mt-8 py-2 px-4 rounded-3xl hover:bg-[#fd8f8f] transition shadow-md">ホームへ</button>

</div>
    @endsection