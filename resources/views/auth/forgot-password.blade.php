<x-guest-layout>

    <!-- Description -->
    <p class="text-sm text-gray-400 mb-6 leading-relaxed">
        Forgot your password? No problem.  
        Just enter your email below and we’ll send you a secure link to reset it.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                Email Address
            </label>

            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
                class="w-full bg-gray-900/60 border border-gray-700 text-white rounded-lg px-4 py-3
                       focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-yellow-600 hover:bg-yellow-500 text-black font-semibold py-3 rounded-lg 
                   transition shadow-lg"
        >
            Email Password Reset Link
        </button>

        <!-- Back to login -->
        <p class="text-center text-sm text-gray-400 mt-4">
            <a href="{{ route('login') }}" class="text-yellow-500 hover:text-yellow-400">
                Back to Login
            </a>
        </p>

    </form>

</x-guest-layout>
