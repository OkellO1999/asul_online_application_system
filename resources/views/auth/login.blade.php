@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-bold text-center text-primary mb-6">Login to ASUL Portal</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('password') border-red-500 @enderror"
                   required autocomplete="current-password">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button type="submit"
                    class="w-full bg-primary text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                Login
            </button>
        </div>

        <div class="text-center">
            <p class="text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-secondary hover:underline">Register here</a>
            </p>
        </div>
        <div class="text-center ">
            <p class="text-green-700">
                <a href="{{ route('home') }}" class="text-secondary hover:underline">Back home</a>
            </p>
        </div>

        <div class="mt-4 text-center text-sm text-gray-500">
            <p><strong>Demo Accounts:</strong></p>
            <p>Admin: admin@asul.ac.ug / password</p>
            <p>Registrar: registrar@asul.ac.ug / password</p>
        </div>
    </form>
</div>
@endsection
