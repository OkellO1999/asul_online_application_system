@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Academic Registrar Dashboard</h1>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Stats Grid -->
        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total Applications
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['total_applications'] }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Pending Review
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['pending_review'] }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Admitted
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $stats['admitted'] }}
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
        </div>

        <!-- Recent Applications -->
        <div class="mt-8">
            <h2 class="text-lg font-medium text-gray-900">Recent Applications</h2>
            <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
                @if($recentApplications->isEmpty())
                    <div class="px-4 py-12 text-center">
                        <p class="text-gray-500">No applications found.</p>
                    </div>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($recentApplications as $application)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-primary truncate">
                                            {{ $application->applicant->user->name }}
                                        </p>
                                        <div class="mt-2 flex">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <span class="mr-4">{{ $application->programme->name }}</span>
                                                <span class="mr-4">{{ $application->application_number }}</span>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                                    $application->status == 'admitted' ? 'bg-green-100 text-green-800' :
                                                    ($application->status == 'under_review' ? 'bg-yellow-100 text-yellow-800' :
                                                    ($application->status == 'submitted' ? 'bg-blue-100 text-blue-800' :
                                                    'bg-gray-100 text-gray-800'))
                                                }}">
                                                    {{ str_replace('_', ' ', ucfirst($application->status)) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <a href="{{ route('registrar.applications.show', $application) }}" class="text-secondary hover:text-purple-900">View</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('registrar.applications') }}" class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6 hover:bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">View All Applications</h3>
                        <p class="text-sm text-gray-500">Review and manage all applications</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('registrar.reports') }}" class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6 hover:bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-secondary rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Generate Reports</h3>
                        <p class="text-sm text-gray-500">Analytics and insights</p>
                    </div>
                </div>
            </a>

            <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-300 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Upcoming Deadline</h3>
                        <p class="text-sm text-gray-500">Next intake: October 2026</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
