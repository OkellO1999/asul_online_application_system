<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASUL Application Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-green: #1e6b52;
            --secondary-purple: #4b286d;
        }
        .bg-primary { background-color: var(--primary-green); }
        .text-primary { color: var(--primary-green); }
        .border-primary { border-color: var(--primary-green); }
        .bg-secondary { background-color: var(--secondary-purple); }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-primary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <img src="/logo.png" alt="ASUL Logo" class="h-10">
                    <span class="text-xl font-bold">ASUL Application Portal</span>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span>Welcome, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-secondary px-4 py-2 rounded hover:bg-purple-700">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

    <footer class="bg-primary text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('m') }} All Saints University - Lango. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
