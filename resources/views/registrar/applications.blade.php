@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Applications Management</h1>

        <!-- Filters -->
        <div class="mt-6 bg-white shadow sm:rounded-lg p-4">
            <form method="GET" action="{{ route('registrar.applications') }}">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="payment_pending" {{ request('status') == 'payment_pending' ? 'selected' : '' }}>Payment Pending</option>
                            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                            <option value="admitted" {{ request('status') == 'admitted' ? 'selected' : '' }}>Admitted</option>
                            <option value="not_admitted" {{ request('status') == 'not_admitted' ? 'selected' : '' }}>Not Admitted</option>
                        </select>
                    </div>

                    <div>
                        <label for="programme" class="block text-sm font-medium text-gray-700">Programme</label>
                        <select name="programme" id="programme" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            <option value="all" {{ request('programme') == 'all' ? 'selected' : '' }}>All Programmes</option>
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->id }}" {{ request('programme') == $programme->id ? 'selected' : '' }}>
                                    {{ $programme->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-green-700">
                            Filter
                        </button>
                        @if(request('status') || request('programme'))
                            <a href="{{ route('registrar.applications') }}" class="ml-2 text-secondary hover:text-purple-700 py-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Applications List -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            @if($applications->isEmpty())
                <div class="px-4 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No applications found</h3>
                    <p class="mt-1 text-sm text-gray-500">No applications match your current filters.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($applications as $application)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($application->applicant->user->name)
                                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-primary">
                                                    <span class="text-sm font-medium leading-none text-white">
                                                        {{ strtoupper(substr($application->applicant->user->name, 0, 1)) }}
                                                    </span>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-primary truncate">
                                                {{ $application->applicant->user->name }}
                                            </p>
                                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                    {{ $application->applicant->user->email }}
                                                </div>
                                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                    {{ $application->programme->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end space-y-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                        $application->status == 'admitted' ? 'bg-green-100 text-green-800' :
                                        ($application->status == 'under_review' ? 'bg-yellow-100 text-yellow-800' :
                                        ($application->status == 'submitted' ? 'bg-blue-100 text-blue-800' :
                                        ($application->status == 'shortlisted' ? 'bg-indigo-100 text-indigo-800' :
                                        ($application->status == 'not_admitted' ? 'bg-red-100 text-red-800' :
                                        'bg-gray-100 text-gray-800'))))
                                    }}">
                                        {{ str_replace('_', ' ', ucfirst($application->status)) }}
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('registrar.applications.show', $application) }}" class="text-secondary hover:text-purple-900 text-sm">
                                            View Details
                                        </a>
                                        <span class="text-gray-400">|</span>
                                        <span class="text-sm text-gray-500">
                                            {{ $application->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
