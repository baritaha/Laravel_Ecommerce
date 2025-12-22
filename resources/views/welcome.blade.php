<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Ecommerce') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-white shadow-sm border border-gray-200 flex items-center justify-center">
                    <x-application-logo class="h-7 w-auto text-primary fill-current" />
                </div>
                <span class="font-semibold tracking-wide">
                    {{ config('app.name', 'Laravel Ecommerce') }}
                </span>
            </div>

            @if (Route::has('login'))
                <div class="flex items-center gap-2">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-800 hover:text-primary hover:border-primary/40 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-800 hover:text-primary hover:border-primary/40 transition">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 rounded-lg bg-primary text-white font-semibold hover:brightness-105 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </header>

        <main class="max-w-7xl mx-auto px-6 pt-10 pb-20">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl sm:text-5xl font-bold tracking-tight">
                    <span class="text-gray-900">Laravel</span>
                    <span class="text-primary">Ecommerce</span>
                </h1>

                <p class="mt-4 text-gray-600 text-lg">
                    A complete ecommerce platform built with Laravel —
                    shopping, orders, and admin management in one system.
                </p>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:brightness-105 transition">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:brightness-105 transition">
                            Start Shopping
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="w-full sm:w-auto px-6 py-3 rounded-xl bg-white border border-gray-200 text-gray-800 hover:text-primary hover:border-primary/40 transition">
                                Create Account
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="mt-14 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm">
                    <div class="text-primary font-semibold">Shopping & Cart</div>
                    <div class="mt-2 text-gray-600">
                        Browse products, add items to cart, and place orders with real-time stock handling.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm">
                    <div class="text-primary font-semibold">Order Management</div>
                    <div class="mt-2 text-gray-600">
                        Track orders, view order details, cancel when allowed, and reorder items easily.
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-gray-200 shadow-sm">
                    <div class="text-primary font-semibold">Admin Dashboard</div>
                    <div class="mt-2 text-gray-600">
                        Manage users, categories, products, orders, and track revenue from completed orders.
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
