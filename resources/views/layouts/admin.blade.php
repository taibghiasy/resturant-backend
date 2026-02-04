<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: true }" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Restaurant Admin') }}</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind + DaisyUI --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0f172a;
        }

        /* Glass sidebar */
        .glass {
            background: rgba(17,25,40,0.85);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
            transition: width 0.3s;
        }

        /* Neon hover effect */
        .neon:hover {
            box-shadow: 0 0 8px rgba(168,85,247,0.8), 0 0 15px rgba(79,70,229,0.6);
        }

        /* Active link glow */
        .sidebar-link-active {
            background: linear-gradient(90deg, rgba(139,92,246,0.5), rgba(79,70,229,0.3));
            border-left: 4px solid #a855f7;
            animation: glow 1s infinite alternate;
        }

        @keyframes glow {
            0% { box-shadow: 0 0 5px #a855f7; }
            100% { box-shadow: 0 0 20px #a855f7; }
        }

        /* Tooltip for collapsed sidebar */
        [x-tooltip]:hover::after {
            content: attr(x-tooltip);
            position: absolute;
            left: 100%;
            margin-left: 0.5rem;
            background: rgba(0,0,0,0.7);
            color: #fff;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            white-space: nowrap;
            font-size: 0.75rem;
        }

        /* Smooth cards */
        .card {
            background: rgba(17,25,40,0.6);
            backdrop-filter: blur(12px);
            border-radius: 1rem;
            border: 1px solid rgba(255,255,255,0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body class="antialiased text-gray-100 " x-data="{ orderCount: 0 }" x-init="
    // fetch initial count
    fetch('/api/admin/orders/unseen-count')
        .then(res => res.json())
        .then(data => orderCount = data.count);

    // polling every 5 seconds
    setInterval(() => {
        fetch('/api/admin/orders/unseen-count')
            .then(res => res.json())
            .then(data => orderCount = data.count);
    }, 5000);
">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" 
           class="glass fixed md:relative h-full md:h-auto flex flex-col p-5 space-y-4">
        
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 x-show="sidebarOpen" class="text-2xl font-bold text-purple-400 drop-shadow transition-all duration-300">🍽 Admin</h1>
            <button @click="sidebarOpen = !sidebarOpen" class="text-purple-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex flex-col space-y-3 flex-1">
            <a href="{{ route('admin.categories.index') }}" 
               x-tooltip="Categories"
               class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('admin.categories.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
                <span class="text-xl">📚</span>
                <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Categories</span>
            </a>

            <a href="{{ route('admin.menues.index') }}" 
               x-tooltip="Menus"
               class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('admin.menues.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
                <span class="text-xl">🍕</span>
                <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Menus</span>
            </a>

            <a href="{{ route('admin.tables.index') }}" 
               x-tooltip="Tables"
               class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('admin.tables.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
                <span class="text-xl">🍽</span>
                <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Tables</span>
            </a>

            <a href="{{ route('admin.reservation.index') }}" 
               x-tooltip="Reservations"
               class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('admin.reservation.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
                <span class="text-xl">📅</span>
                <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Reservations</span>
            </a>

            <a href="{{ route('admin.signature-dishes.index') }}" 
       x-tooltip="Signature Dishes"
       class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('signature-dishes.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
        <span class="text-xl">🍲</span>
        <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Signature Dishes</span>
    </a>

  <a href="{{ route('admin.orders.index') }}" 
   x-tooltip="Orders"
   @click.prevent="
       fetch('/api/admin/orders/mark-seen', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
           .then(() => orderCount = 0);
       window.location.href='{{ route('admin.orders.index') }}';
   "
   class="flex items-center p-3 rounded-lg transition neon {{ request()->routeIs('admin.orders.*') ? 'sidebar-link-active' : 'hover:bg-white/10' }}">
    <span class="text-xl">🛒</span>
    <span x-show="sidebarOpen" class="ml-3 transition-all duration-300">Orders</span>
    <span x-text="orderCount" 
          x-show="orderCount > 0" 
          class="ml-auto bg-red-500 text-white px-2 py-0.5 rounded-full text-sm font-bold transition"></span>
</a>



        </nav>

        {{-- User Logout --}}
        <div class="mt-auto pt-6 border-t border-white/10">
            <p x-show="sidebarOpen" class="text-sm text-gray-400 mb-2 transition-all duration-300">{{ Auth::user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center justify-start p-3 rounded-lg hover:bg-red-500/20 hover:text-red-300 transition">
                    <span class="text-xl mr-2">🔓</span>
                    <span x-show="sidebarOpen" class="transition-all duration-300">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300 p-6 space-y-6">
        {{ $slot }}
    </main>

</div>

</body>
</html>
