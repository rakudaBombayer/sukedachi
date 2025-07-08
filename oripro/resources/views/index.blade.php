@extends('layouts.app')

@section('content')

    <nav>
        <ul>
            {{-- <li><a href="{{ route('requests.create') }}" style="color: red;">手伝って</a></li> --}}

            @auth
                <p>ようこそ、{{ Auth::user()->nickname }} さん！</p>
                    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
                </form>

            {{-- <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a> --}}

            @else
                <p>ログインしていません。</p>
                <a href="{{ route('login') }}">ログイン</a>
            @endauth
        </ul>
    </nav>

    <div>

        <div class="max-w-5xl mx-auto px-4">
            {{-- ↓ボタンのレスポンシブはあとでカスタマイズする --}}
            <button onclick="location.href='{{ route('requests.create') }}'" class="bg-[#FF9D9D] text-2xl text-white font-black px-6 py-4 my-6 sm:my-6 md:my-8 lg:my-12 shadow rounded-full border  hover:bg-[#fb9292]  border border-[#bb6d6d] transition w-full max-w-[400px] mx-auto">手伝って</button>


            @if (isset($allRequests) && count($allRequests) > 0)
            {{-- <div class="max-w-5xl mx-auto px-4"> --}}
            {{-- < class="grid grid-cols-1 md:grid-cols-2 gap-4"> --}}

            {{-- ↓仮 --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                
                @foreach ($allRequests as $request)
                    <div class="bg-[#FEE1E1] shadow rounded-md p-4 hover:bg-[#FF9D9D] transition aspect-square min-h-[100px]">
                        <a href="{{ route('requests.show', $request->request_ID) }}" class="font-semibold text-black hover:underline block">{{ $request->title }}</a>
                        <p class="text-sm font-bold text-gray-600 mt-1">場所 {{ $request->general_area }}</p>
                    </div>
                            
                @endforeach
            </div>

            @else
                <p>まだ投稿された依頼はありません。</p>
            @endif
            </div>
        </div>
    </div>
@endsection