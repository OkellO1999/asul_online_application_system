@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Admin Dashboard</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total Users
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['total_users'] }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total Programmes
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['total_programmes'] }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Active Programmes
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['active_programmes'] }}
                    </dd>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('admin.programmes.create') }}" class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6 hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-primary rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Add New Programme</h3>
                            <p class="text-sm text-gray-500">Create a new academic programme</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.users.create') }}" class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6 hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-secondary rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Create User</h3>
                            <p class="text-sm text-gray-500">Add new staff or applicant</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.programmes.index') }}" class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6 hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Manage Programmes</h3>
                            <p class="text-sm text-gray-500">View and edit programmes</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
