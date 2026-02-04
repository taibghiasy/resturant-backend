<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                Email
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">
                Password
            </label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me + Forgot -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded bg-gray-900 border-gray-700 text-yellow-500 focus:ring-yellow-600"
                >
                <span class="ml-2 text-sm text-gray-400">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="text-sm text-yellow-500 hover:text-yellow-400"
                >
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Sign In Button -->
        <button
            type="submit"
            class="w-full bg-yellow-600 hover:bg-yellow-500 text-black font-semibold py-3 rounded-lg transition shadow-lg"
        >
            Sign in
        </button>

        <!-- Register Link -->
        <p class="text-center text-sm text-gray-400 mt-3">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-400">
                Register
            </a>
        </p>

    </form>

</x-guest-layout>
