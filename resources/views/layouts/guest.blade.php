<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Restaurant Management') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-900 text-white">

    <div class="min-h-screen w-full flex flex-col md:flex-row">

        <!-- LEFT: Hero Image (hidden on small screens) -->
<div class="hidden md:block md:w-1/2 relative h-screen overflow-hidden">
    <img 
        src="{{ asset('11.png') }}" 
        alt="Restaurant Chef"
        class="w-full h-full object-cover object-center"
    >
    <div class="absolute inset-0 bg-black/30"></div>
</div>

        <!-- RIGHT: Form Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-[#0E0E0E] px-6 py-10">
            <div class="w-full max-w-md">

                <!-- Logo (fixed size) -->
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('9.png') }}" 
                         alt="Logo"
                         class="w-28 h-auto md:w-40 opacity-95">
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-center text-white">
                    {{ $title ?? 'Welcome' }}
                </h1>

                <p class="text-center text-gray-400 mt-2 mb-8">
                    {{ $subtitle ?? 'Sign in or create your account to manage your restaurant' }}
                </p>

                <!-- Dynamic Form Slot -->
                <div class="mt-4">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <p class="mt-10 text-center text-gray-600 text-xs">
                    &copy; {{ date('Y') }} Restaurant Management System — All rights reserved.
                </p>

            </div>
        </div>
    </div>

</body>
</html>
