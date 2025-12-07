@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Reports & Analytics</h1>

        <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Applications by Programme -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Applications by Programme</h3>
                </div>
                <div class="border-t border-gray-200">
                    <div class="px-4 py-5 sm:p-6">
                        @if($applicationsByProgramme->isEmpty())
                            <p class="text-gray-500">No data available.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($applicationsByProgramme as $item)
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="font-medium">{{ $item->name }}</span>
                                        <span>{{ $item->count }} applications</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary h-2 rounded-full"
                                             style="width: {{ ($item->count / max($applicationsByProgramme->max('count'), 1)) * 100 }}%">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Applications by Status -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Applications by Status</h3>
                </div>
                <div class="border-t border-gray-200">
                    <div class="px-4 py-5 sm:p-6">
                        @if($applicationsByStatus->isEmpty())
                            <p class="text-gray-500">No data available.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($applicationsByStatus as $item)
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="font-medium">{{ str_replace('_', ' ', ucfirst($item->status)) }}</span>
                                        <span>{{ $item->count }} applications</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="
                                            {{ $item->status == 'admitted' ? 'bg-green-500' :
                                               ($item->status == 'under_review' ? 'bg-yellow-500' :
                                               ($item->status == 'submitted' ? 'bg-blue-500' :
                                               ($item->status == 'shortlisted' ? 'bg-indigo-500' :
                                               ($item->status == 'not_admitted' ? 'bg-red-500' :
                                               'bg-gray-500'))))
                                            }} h-2 rounded-full"
                                             style="width: {{ ($item->count / max($applicationsByStatus->sum('count'), 1)) * 100 }}%">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Summary -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Total Applications
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $applicationsByStatus->sum('count') }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Under Review
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $applicationsByStatus->where('status', 'under_review')->first()->count ?? 0 }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Admitted
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $applicationsByStatus->where('status', 'admitted')->first()->count ?? 0 }}
                    </dd>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        Not Admitted
                    </dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">
                        {{ $applicationsByStatus->where('status', 'not_admitted')->first()->count ?? 0 }}
                    </dd>
                </div>
            </div>
        </div>

        <!-- Export Options -->
        <div class="mt-8 bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Export Data</h3>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <button type="button" onclick="alert('This functionality is coming your way soon, Thanks for the patience!')" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Export Applications (Excel)
                    </button>
                    <button type="button" onclick="alert('This functionality is coming your way soon, Thanks for the patience!')" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-secondary hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                        Export Reports (PDF)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
