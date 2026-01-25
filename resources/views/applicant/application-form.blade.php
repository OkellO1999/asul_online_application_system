@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Application Form</h1>

        @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-6 bg-white shadow sm:rounded-md">
            <div class="px-4 py-5 sm:p-6">
                <form method="POST" action="{{ route('applicant.application.store') }}" enctype="multipart/form-data" id="applicationForm">
                    @csrf

                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="personal_details[name]" id="name" value="{{ old('personal_details.name', Auth::user()->name) }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="personal_details[email]" id="email" value="{{ old('personal_details.email', Auth::user()->email) }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" readonly>
                            </div>

                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input type="date" name="personal_details[date_of_birth]" id="date_of_birth" value="{{ old('personal_details.date_of_birth') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="personal_details[gender]" id="gender" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('personal_details.gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('personal_details.gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('personal_details.gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                                <input type="text" name="personal_details[nationality]" id="nationality" value="{{ old('personal_details.nationality', 'Ugandan') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input type="text" name="personal_details[country]" id="country" value="{{ old('personal_details.country', 'Uganda') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                                <input type="text" name="personal_details[district]" id="district" value="{{ old('personal_details.district') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="personal_details[address]" id="address" value="{{ old('personal_details.address') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Emergency Contact</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                            <div>
                                <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                <input type="text" name="personal_details[emergency_contact_name]" id="emergency_contact_name" value="{{ old('personal_details.emergency_contact_name') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                                <input type="tel" name="personal_details[emergency_contact_phone]" id="emergency_contact_phone" value="{{ old('personal_details.emergency_contact_phone') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700">Relationship</label>
                                <input type="text" name="personal_details[emergency_contact_relationship]" id="emergency_contact_relationship" value="{{ old('personal_details.emergency_contact_relationship') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Academic Records - O Level -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">PLE Academic Records</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="olevel_school" class="block text-sm font-medium text-gray-700">School Name</label>
                                <input type="text" name="academic_records[olevel][school]" id="olevel_school" value="{{ old('academic_records.olevel.school') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="olevel_index" class="block text-sm font-medium text-gray-700">Index Number</label>
                                <input type="text" name="academic_records[olevel][index_number]" id="olevel_index" value="{{ old('academic_records.olevel.index_number') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="olevel_year" class="block text-sm font-medium text-gray-700">Year Completed</label>
                                <input type="number" name="academic_records[olevel][year_obtained]" id="olevel_year" min="1980" max="2024" value="{{ old('academic_records.olevel.year_obtained') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="olevel_grades" class="block text-sm font-medium text-gray-700">Grades (e.g., D1, D2, C3...)</label>
                                <input type="text" name="academic_records[olevel][grades]" id="olevel_grades" value="{{ old('academic_records.olevel.grades') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="olevel_certificate" class="block text-sm font-medium text-gray-700">PLE Slip</label>
                                <input type="file" name="academic_records[olevel][certificate]" id="olevel_certificate" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG format, max 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Records - A Level -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">O-level (UCE) Academic Records</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="alevel_school" class="block text-sm font-medium text-gray-700">School Name</label>
                                <input type="text" name="academic_records[alevel][school]" id="alevel_school" value="{{ old('academic_records.alevel.school') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="alevel_index" class="block text-sm font-medium text-gray-700">Index Number</label>
                                <input type="text" name="academic_records[alevel][index_number]" id="alevel_index" value="{{ old('academic_records.alevel.index_number') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="alevel_year" class="block text-sm font-medium text-gray-700">Year Completed</label>
                                <input type="number" name="academic_records[alevel][year_obtained]" id="alevel_year" min="1980" max="2024" value="{{ old('academic_records.alevel.year_obtained') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div>
                                <label for="alevel_grades" class="block text-sm font-medium text-gray-700">Grades</label>
                                <input type="text" name="academic_records[alevel][grades]" id="alevel_grades" value="{{ old('academic_records.alevel.grades') }}" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>

                            <div class="sm:col-span-2">
                                <label for="alevel_certificate" class="block text-sm font-medium text-gray-700">UCE Certificate/Transcript</label>
                                <input type="file" name="academic_records[alevel][certificate]" id="alevel_certificate" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG format, max 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Programme Selection -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Programme Selection</h3>
                        <div>
                            <label for="programme_id" class="block text-sm font-medium text-gray-700">Select Programme</label>
                            <select name="programme_id" id="programme_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <option value="">Select a programme</option>
                                @foreach($programmes as $programme)
                                    <option value="{{ $programme->id }}" {{ old('programme_id') == $programme->id ? 'selected' : '' }}>
                                        {{ $programme->name }} ({{ $programme->code }}) - UGX {{ number_format($programme->application_fee) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Document Upload -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Required Documents</h3>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="photo" class="block text-sm font-medium text-gray-700">Passport Photo</label>
                                <input type="file" name="photo" id="photo" accept="image/*" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">JPG, PNG format, max 2MB</p>
                            </div>

                            <div>
                                <label for="id_document" class="block text-sm font-medium text-gray-700">National ID/Passport</label>
                                <input type="file" name="id_document" id="id_document" accept=".pdf,.jpg,.jpeg,.png" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG format, max 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Declaration -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Declaration</h3>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" id="declaration" name="declaration" required
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="declaration" class="font-medium text-gray-700">
                                    I declare that the information provided in this application is true, complete, and accurate to the best of my knowledge.
                                </label>
                                <p class="text-gray-500 mt-1">
                                    I understand that any false or misleading information may result in the rejection of my application or subsequent dismissal from the university.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('applicant.dashboard') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Cancel
                        </a>
                        <button type="submit" id="submitBtn" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('applicationForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';
        });
    });
</script>
@endsection
