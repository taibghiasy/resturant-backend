<nav x-data="{ open: false }" class="fixed top-0 left-0 h-full w-64  bg-opacity-50 backdrop-blur-md shadow-lg z-50 flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-700">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="h-12 w-auto fill-current text-white" />
        </a>
    </div>

    <!-- Desktop Navigation Links -->
    <div class="flex-1 px-4 py-6 space-y-4 hidden sm:flex flex-col">
        <x-admin-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-400">
            {{ __('Dashboard') }}
        </x-admin-nav-link>

        @if (Auth::user()->is_admin)
            <x-admin-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="text-white hover:text-yellow-400">
                {{ __('Admin') }}
            </x-admin-nav-link>
        @endif
    </div>

    <!-- User Dropdown -->
<div class="hidden sm:flex sm:items-center sm:ml-6 mb-20">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex items-center justify-between w-full px-3 py-2 rounded-md text-white hover:text-yellow-400 focus:outline-none transition">
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-2 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')" class="text-white ">{{ __('Profile') }}</x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>


    <!-- Mobile Hamburger -->
    <div class="sm:hidden flex justify-between items-center px-4 py-4 border-b border-gray-700">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-yellow-400 focus:outline-none transition">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <span class="text-white font-semibold">{{ Auth::user()->name }}</span>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden bg-black bg-opacity-70 backdrop-blur-md flex flex-col px-4 py-4 space-y-2">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        @if (Auth::user()->is_admin)
            <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="text-white">
                {{ __('Admin') }}
            </x-responsive-nav-link>
        @endif

        <div class="pt-4 border-t border-gray-700">
            <x-responsive-nav-link :href="route('profile.edit')" class="text-white">{{ __('Profile') }}</x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" class="text-white" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
