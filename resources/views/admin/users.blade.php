@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Users Management</h1>
            <a href="{{ route('admin.users.create') }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-green-700">
                Create User
            </a>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            @if($users->isEmpty())
                <div class="px-4 py-12 text-center">
                    <p class="text-gray-500">No users found.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-primary truncate">
                                        {{ $user->name }}
                                    </p>
                                    <div class="mt-2 flex">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <span class="mr-4">{{ $user->email }}</span>
                                            <span class="mr-4">{{ $user->phone }}</span>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' :
                                                   ($user->role === 'registrar' ? 'bg-blue-100 text-blue-800' :
                                                   'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500">
                                        Joined {{ $user->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
