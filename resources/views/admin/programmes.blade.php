@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Programmes Management</h1>
            <a href="{{ route('admin.programmes.create') }}" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-green-700">
                Add New Programme
            </a>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            @if($programmes->isEmpty())
                <div class="px-4 py-12 text-center">
                    <p class="text-gray-500">No programmes found. Create your first programme.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($programmes as $programme)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-primary truncate">
                                        {{ $programme->name }}
                                    </p>
                                    <div class="mt-2 flex">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <span class="mr-4">Code: {{ $programme->code }}</span>
                                            <span class="mr-4">Duration: {{ $programme->duration }} years</span>
                                            <span>Fee: UGX {{ number_format($programme->application_fee) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $programme->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $programme->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <a href="{{ route('admin.programmes.edit', $programme) }}" class="text-secondary hover:text-purple-900">Edit</a>
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
