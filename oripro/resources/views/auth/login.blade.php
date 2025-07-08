@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center pt-12 bg-white">

    <div class="w-full max-w-md mx-auto p-4">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        {{-- <div> --}}
        <div class="flex flex-col gap-2 items-center">
            <x-input-label for="email" :value="__('メールアドレス')"  />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] rounded-full px-4 py-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        

        <!-- Password -->
        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] rounded-full px-4 py-2"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
         <div class="flex flex-col items-center mt-6">

        <button class="w-3/4 bg-[#FF9D9D] text-white font-bold mb-2 px-4 py-2 rounded-[30px] hover:bg-[#fd8f8f] transition">
                {{ __('ログイン') }}
        </button>
        
        <a href="{{ route('register') }}" class="w-3/4 bg-white text-[#FF9D9D] border border-[#FF9D9D] text-center font-bold px-4 py-2 rounded-full hover:bg-[#FFE9E9] transition">
            {{ __('新規登録はこちら') }}
        </a>

        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('パスワードを忘れた方はこちらから') }}
                </a>
            @endif

            
        </div>
    </form>
    </div>
</div>
@endsection

