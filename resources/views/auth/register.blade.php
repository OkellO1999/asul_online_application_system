@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-bold text-center text-primary mb-6">Create Applicant Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">Full Name</label>
            <input type="text" id="name" name="name"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('name') border-red-500 @enderror"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
            <input type="tel" id="phone" name="phone"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('phone') border-red-500 @enderror"
                   value="{{ old('phone') }}" required>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary @error('password') border-red-500 @enderror"
                   required autocomplete="new-password">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-primary"
                   required autocomplete="new-password">
        </div>

        <div class="mb-6">
            <button type="submit"
                    class="w-full bg-primary text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                Register
            </button>
        </div>

        <div class="text-center">
            <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-secondary hover:underline">Login here</a>
            </p>
        </div>
        <div class="text-center">
            <p class="text-green-700">
                <a href="{{ route('home') }}" class="text-secondary hover:underline">Back home</a>
            </p>
        </div>
    </form>
</div>
@endsection
