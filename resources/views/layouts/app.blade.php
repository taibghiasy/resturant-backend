<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restaurant Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <!-- Full Background Image -->
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/13.png');">
        
        <!-- Overlay to darken the image for readability -->
        <div class="min-h-screen bg-black bg-opacity-50 flex flex-col">

            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-white drop-shadow-lg">{{ $header }}</h1>
                </header>
            @endisset

            <!-- Main Content -->
            <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="text-center text-gray-300 text-sm py-4 border-t border-gray-700">
                &copy; {{ date('Y') }} Restaurant Management System
            </footer>
        </div>
    </div>

</body>
</html>
