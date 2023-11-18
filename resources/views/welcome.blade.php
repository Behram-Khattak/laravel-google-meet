<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="grid space-y-5 items-center h-screen sm:items-center py-4 sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 capitalize">
                <h1 class="text-gray-800 text-8xl font-bold">meet & greet</h1>

                <div class="authentication-buttons text-center">
                    @if (Route::has('login'))
                        <div class="hidden px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-800 hover:bg-gray-700 hover:text-white border border-gray-500 py-3 px-6 rounded-lg">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-800 hover:bg-gray-700 hover:text-white border border-gray-700 py-3 px-6 rounded-lg">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-800 hover:bg-gray-700 hover:text-white border border-gray-700 py-3 px-6 rounded-lg">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
