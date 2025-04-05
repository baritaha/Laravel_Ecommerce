<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fullscreen Video Background */
        /* Fullscreen Video Background */
        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: -1;
            background-color: black;
            /* Fallback in case video doesn't load */
        }

        /* Make the content background transparent */
        .min-h-screen {
            background: transparent !important;
        }

        /* Make header and other content transparent */
        header,
        .bg-white,
        .dark\:bg-gray-800 {
            background: rgba(255, 255, 255, 0.1) !important;
            /* Slight transparency */
            backdrop-filter: blur(5px);
            /* Optional: Adds a blurred effect */
        }

        /* Ensure text is visible */
        .text-gray-900,
        .dark\:text-gray-100 {
            color: white !important;
        }

        .btnDesign {
            background-color: #F5F5DC;
            color: goldenrod;
            border: 2px solid goldenrod;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;

        }

        .btnDesign:hover {
            background-color: rgb(124, 91, 7);
            color: #F5F5DC;
            border: 2px solid #F5F5DC;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;

        }

        .titleText {
            color: #f3f3b7;
            opacity: 0.7;
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            text-decoration: underline;
            text-shadow: 12px 12px 24px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- Video Background -->
    <video autoplay muted loop id="video-background">
        <source src="{{ asset('videos/Ecom3.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 content">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-6 px-4 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

</body>

</html>
