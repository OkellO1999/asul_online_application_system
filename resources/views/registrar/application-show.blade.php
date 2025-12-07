@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Application Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('registrar.applications') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Back to List
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Application Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Applicant Information -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Applicant Information</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->applicant->user->name }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->applicant->user->email }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->applicant->user->phone ?? 'N/A' }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if($application->applicant->date_of_birth)
                                        {{ \Carbon\Carbon::parse($application->applicant->date_of_birth)->format('F d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ ucfirst($application->applicant->gender) }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Nationality</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->applicant->nationality }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->applicant->address }}, {{ $application->applicant->district }}, {{ $application->applicant->country }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Academic Records -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Academic Records</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        @forelse($application->applicant->academicRecords as $record)
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 last:border-b-0">
                            <h4 class="text-md font-medium text-gray-900 mb-3">{{ $record->qualification }}</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Institution</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $record->institution_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Year Obtained</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $record->year_obtained }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Index Number</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $record->index_number }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Grades</p>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @php
                                            $grades = json_decode($record->grades, true);
                                            echo $grades['raw'] ?? 'N/A';
                                        @endphp
                                    </p>
                                </div>
                                <div class="sm:col-span-2">
                                    <p class="text-sm font-medium text-gray-500">Certificate</p>
                                    @if($record->certificate_path)
                                        <a href="{{ Storage::url($record->certificate_path) }}" target="_blank" class="mt-1 inline-flex items-center text-secondary hover:text-purple-700">
                                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View Certificate
                                        </a>
                                    @else
                                        <p class="mt-1 text-sm text-gray-500">No certificate uploaded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="px-4 py-5 sm:px-6">
                            <p class="text-sm text-gray-500">No academic records found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Actions and Status -->
            <div class="space-y-6">
                <!-- Application Summary -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Application Summary</h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Application No.</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->application_number }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Programme</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->programme->name }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Applied On</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ $application->created_at->format('F d, Y h:i A') }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Application Fee</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    UGX {{ number_format($application->programme->application_fee) }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Current Status</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
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
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Update Status -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Update Status</h3>
                        <form method="POST" action="{{ route('registrar.applications.status', $application) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="shortlisted" {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted for Interview</option>
                                    <option value="admitted" {{ $application->status == 'admitted' ? 'selected' : '' }}>Admitted</option>
                                    <option value="not_admitted" {{ $application->status == 'not_admitted' ? 'selected' : '' }}>Not Admitted</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                                    placeholder="Add internal notes about this application...">{{ old('notes', $application->notes) }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-md hover:bg-green-700">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Uploaded Documents -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Uploaded Documents</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Passport Photo</p>
                                @if($application->photo_path)
                                    <a href="{{ Storage::url($application->photo_path) }}" target="_blank" class="text-sm text-secondary hover:text-purple-700 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View Photo
                                    </a>
                                @else
                                    <p class="text-sm text-gray-500">No photo uploaded</p>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-700">ID Document</p>
                                @if($application->id_path)
                                    <a href="{{ Storage::url($application->id_path) }}" target="_blank" class="text-sm text-secondary hover:text-purple-700 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View ID
                                    </a>
                                @else
                                    <p class="text-sm text-gray-500">No ID document uploaded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Emergency Contact</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Contact Name</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->applicant->emergency_contact_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->applicant->emergency_contact_phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Relationship</p>
                                <p class="mt-1 text-sm text-gray-900">{{ $application->applicant->emergency_contact_relationship }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
