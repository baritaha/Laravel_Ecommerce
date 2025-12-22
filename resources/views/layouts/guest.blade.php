<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Ecommerce') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen page-bg flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <a href="{{ url('/') }}" class="flex items-center justify-center gap-3 mb-6">
                <x-application-logo class="h-11 w-auto text-primary" />
                <span class="text-lg font-semibold tracking-tight">
                    <span class="text-gray-900">Laravel</span>
                    <span class="text-primary">Ecommerce</span>
                </span>
            </a>

            <div class="bg-white/85 backdrop-blur-xl border border-white shadow-xl rounded-3xl p-8">
                {{ $slot }}
            </div>

            <p class="mt-6 text-center text-xs text-gray-500">
                © {{ date('Y') }} Laravel Ecommerce. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
