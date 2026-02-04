<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">
                Name
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3 
                       focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                Email
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3 
                       focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">
                Password
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3 
                       focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">
                Confirm Password
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3
                       focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between pt-2">

            <a href="{{ route('login') }}"
               class="text-sm text-gray-400 hover:text-yellow-400 transition">
                Already registered?
            </a>

            <button
                type="submit"
                class="bg-yellow-600 hover:bg-yellow-500 text-black font-semibold py-3 px-6 rounded-lg transition shadow-lg"
            >
                Register
            </button>
        </div>

    </form>

</x-guest-layout>
