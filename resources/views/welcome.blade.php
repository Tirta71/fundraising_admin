<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Charite - Charity</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        .btn-gradient {
            @apply bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white font-semibold py-2 px-6 rounded-full shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl relative;
        }
        .hero-bg {
            background: url('https://plus.unsplash.com/premium_photo-1682310528700-dbe5a05d99c6?q=80&w=2112&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            height: 100vh;
            overflow: hidden;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .text-fade-in {
            animation: fadeInText 2s ease-out forwards;
        }
        @keyframes fadeInText {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .btn-hover-underline::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: white;
            visibility: hidden;
            transform: scaleX(0);
            transition: all 0.3s ease-in-out;
        }
        .btn-hover-underline:hover::before {
            visibility: visible;
            transform: scaleX(1);
        }
        .pulse-animate {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .fade-in {
            animation: fadeIn 2s ease-out forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style>
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white">
    <div class="hero-bg">
        <div class="overlay"></div>
        <div class="relative min-h-screen flex items-center justify-center text-center text-white px-6 py-12 lg:py-24">
            <div class="fade-in w-full max-w-7xl">
                <header class="mb-10">
                    <h1 class="text-4xl lg:text-6xl font-bold">
                        Welcome to Charite
                    </h1>
                    <p class="mt-4 text-lg lg:text-2xl">
                        Empowering Communities through Charity.
                    </p>
                </header>
                <nav class="fade-in">
                    @if (Route::has('login'))
                        <div class="flex justify-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-gradient btn-hover-underline pulse-animate">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-gradient btn-hover-underline pulse-animate">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-gradient btn-hover-underline pulse-animate">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </nav>
                <footer class="mt-20 text-sm text-gray-300">
                    Charite v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
