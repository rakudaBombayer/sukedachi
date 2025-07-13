@extends('layouts.app')

@section('content')

<div class="flex flex-col pt-6 items-center min-h-screen text-center">
    <div class="font-bold text-base sm:text-lg md:text-xl lg:text-2xl">投稿できました。</div>
    <div class="font-bold text-base sm:text-lg md:text-xl lg:text-2xl">応募があるまでお待ちください。</div>

    <div class="mt-4">
         <div>投稿内容</div>
        <ul>
            <li>タイトル: {{ $request->title }}</li>
            <li>お手伝い種類: {{ $request->help_category_ID }}</li>
            <li>お手伝い種類: {{ $helpCategory }}</li>
            <li>お手伝い詳細: {{ $request->help_details }}</li>
            <li>希望日、希望時間: {{ $request->requested_date }}</li>
        
        @if ($request->image)
            <img src="{{ $request->image->image }}?v={{ time() }}" alt="投稿画像" loading="lazy" style="max-width: 200px;">
        @endif

    
            <li>所要時間: {{ $request->estimated_time }}</li>
            <li>大まかな場所: {{ $request->general_area }}</li>
            {{-- <li>募集期限: {{ $request->deadline }}</li> --}}
            <li>投稿日時: {{ $request->created_at }}</li>
        </ul>

        {{-- <button><a href="{{ route('index') }}" style="color: red;">ホームへ</a></button> --}}
        <button onclick="window.location.href='{{ route('index') }}'" class="bg-[#FF9D9D] text-xl font-bold text-white mt-8 py-2 px-4 rounded-3xl hover:bg-[#fd8f8f] transition shadow-md">ホームへ</button>
    </div>
   

</div>
    

@endsection