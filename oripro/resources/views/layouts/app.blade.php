{{-- @extends('layouts.app') --}}



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>スケダチ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <!-- ファーストビュー画像 -->
                {{-- ↓画像として --}}
                {{-- <div class="w-full mx-auto h-[300px] md:h-[400px] lg:h-[500px] overflow-hidden">
                    <img src="{{ asset('images/hand_kari.png') }}" alt="ファーストビュー画像" class="w-full h-full object-cover block" />
                </div> --}}
                {{-- ↓背景として --}}
                <div
                    class="w-full h-[300px] md:h-[400px] lg:h-[400px] bg-cover bg-center"
                    style="background-image: url('{{ asset('images/hand_kari.png') }}');">
                </div>
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>