<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okss Application Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-green: #800000;
            --secondary-purple: #3a18fcdc;
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
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                        <img src="{{asset('images/logo.png')}}" alt="OKSS" srcset="" class="w-12 h-12 rounded-full">
                    </div>
                    <span class="text-xl font-bold">Okwang ss Application Portal</span>
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

            @auth
            <div class="pb-2">
                <div class="flex space-x-6">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200 {{ request()->is('admin*') ? 'font-bold' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.programmes.index') }}" class="hover:text-gray-200">Programmes</a>
                        <a href="{{ route('admin.users.index') }}" class="hover:text-gray-200">Users</a>
                    @elseif(Auth::user()->isRegistrar())
                        <a href="{{ route('registrar.dashboard') }}" class="hover:text-gray-200 {{ request()->is('registrar*') ? 'font-bold' : '' }}">Dashboard</a>
                        <a href="{{ route('registrar.applications') }}" class="hover:text-gray-200">Applications</a>
                        <a href="{{ route('registrar.reports') }}" class="hover:text-gray-200">Reports</a>
                    @elseif(Auth::user()->isApplicant())
                        <a href="{{ route('applicant.dashboard') }}" class="hover:text-gray-200 {{ request()->is('applicant*') ? 'font-bold' : '' }}">Dashboard</a>
                        <a href="{{ route('applicant.apply') }}" class="hover:text-gray-200">Apply</a>
                        <a href="{{ route('applicant.status') }}" class="hover:text-gray-200">Application Status</a>
                    @endif
                </div>
            </div>
            @endauth
        </div>
    </nav>

    <main class="py-8">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-primary text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Okwang Secondary School - Otuke. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
