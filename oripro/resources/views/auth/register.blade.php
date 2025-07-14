@extends('layouts.app')

@section('content')


<div class="min-h-screen flex justify-center pt-12 bg-white">
    <div class="w-full max-w-md mx-auto p-4">
        <div class="flex flex-col gap-2 items-center">
            <div class="font-bold text-2xl mb-2">
                新規登録画面
            </div>
        </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="flex flex-col gap-2 items-center">
            <x-input-label for="nickname" :value="__('ニックネーム')" />
            <x-text-input id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname')" required autofocus autocomplete="nickname" class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2"/>
            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
        </div>

        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="address" :value="__('だいたい住所')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" 
            placeholder="市区町村まで"
            required autofocus autocomplete="address" class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="self_introduction" :value="__('自己紹介')" />
            <textarea id="self_introduction" class="block mt-1 w-3/4 !rounded-full shadow-sm bg-[#F2EEEE] border-[#F2EEEE] focus:border-indigo-500 focus:ring-indigo-500" name="self_introduction" rows="5" required  autofocus autocomplete="self_introduction">{{ old('self_introduction') }}</textarea>
            <x-input-error :messages="$errors->get('self_introduction')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="8桁以上の英数字でお願いします。"
                            required autocomplete="new-password" 
                            class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2"
                            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 flex flex-col gap-2 items-center">
            <x-input-label for="password_confirmation" :value="__('確認用パスワード')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="上と同じものを入力してください。"
                            class="w-3/4 bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2"
                            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="mt-4 flex flex-col gap-2 items-center">
            <button class="w-3/4 bg-[#FF9D9D] text-white font-bold mb-2 px-4 py-2 rounded-[30px] hover:bg-[#fd8f8f] transition">
                {{ __('登録') }}
            </button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('すでに登録済みの方はこちら') }}
            </a>

            
        </div>
    </form>
  </div>
</div>

@endsection

