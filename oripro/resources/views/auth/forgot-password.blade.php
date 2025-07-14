@extends('layouts.app')

@section('content')

{{-- <x-guest-layout> --}}
    <div class="min-h-screen flex justify-center pt-12 bg-white">
    <div class="mb-4 text-sm text-gray-600">
        {{-- {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} --}}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="flex flex-col gap-2 items-center">
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-text-input id="email" class=" bg-[#F2EEEE] border border-[#F2EEEE] !rounded-full px-4 py-2" type="email" name="email" :value="old    ('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" !important/>
            </div>

            <div class="flex items-center justify-end mt-4">
                {{-- <x-primary-button class="!important  bg-[#FF9D9D] text-white font-bold mb-2 px-4 py-2 rounded-[30px] hover:bg-[#fd8f8f] transition">
                    {{ __('リセット') }}
                </x-primary-button> --}}
                {{-- //↓タグを変えているのでエラーになる可能性あり --}}
                <button class="w-full bg-[#FF9D9D] text-white font-bold mb-2 px-4 py-2 rounded-[30px] hover:bg-[#fd8f8f] transition">
                    {{ __('リセット') }}
                </button>
            </div>
        </form>
    </div>
{{-- </x-guest-layout> --}}
@endsection