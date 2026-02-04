<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100 flex items-center justify-center min-h-screen">

    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1470&q=80" 
             alt="Restaurant Background" 
             class="w-full h-full object-cover opacity-40">
        <div class="absolute  bg-gray-600 "></div>
    </div>

    <!-- Main grid container -->
    <div class="relative z-10 grid gap-8 text-center w-full max-w-4xl px-6">
        
        <!-- Header / Logo -->
        <div>
            <h1 class="text-4xl lg:text-5xl font-bold text-yellow-400 mb-2">Restaurant RMS</h1>
            <p class="text-gray-200 text-lg">Efficiently manage orders, staff, and daily operations</p>
        </div>

        <!-- Welcome card -->
        <div class="   rounded-xl shadow-xl p-10 grid gap-6">
            <h2 class="text-3xl font-semibold">Welcome Back!</h2>
            <p class="text-gray-300">Access your dashboard to manage all restaurant operations seamlessly.</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-center">
                @if(Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-6 py-3 bg-yellow-500 text-gray-900 rounded-md font-semibold hover:bg-yellow-600 transition">
                           Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-6 py-3 rounded-md border border-gray-400 hover:bg-gray-700 transition">
                           Log In
                        </a>
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-6 py-3 bg-yellow-500 text-gray-900 rounded-md font-semibold hover:bg-yellow-600 transition">
                               Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-gray-400 text-sm mt-4">
            &copy; {{ date('Y') }} Restaurant RMS. All rights reserved.
        </footer>
    </div>

</body>
</html>
