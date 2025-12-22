<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen page-bg">
        @include('layouts.navigation')

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-4 card p-4 border-l-4 border-primary bg-primary-50/60">
                    <p class="font-medium text-primary-800">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 card p-4 border-l-4 border-red-500 bg-red-50/70">
                    <p class="font-medium text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
