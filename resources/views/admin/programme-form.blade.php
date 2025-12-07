@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">
            {{ isset($programme) ? 'Edit Programme' : 'Create New Programme' }}
        </h1>

        <div class="mt-6 bg-white shadow sm:rounded-md sm:overflow-hidden">
            <form method="POST"
                action="{{ isset($programme) ? route('admin.programmes.update', $programme) : route('admin.programmes.store') }}">
                @csrf
                @if(isset($programme))
                    @method('PUT')
                @endif

                <div class="px-4 py-5 sm:p-6 space-y-6">
                    <!-- Form fields remain the same -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Programme Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $programme->name ?? '') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">Programme Code</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $programme->code ?? '') }}" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            @error('code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration (years)</label>
                            <input type="number" name="duration" id="duration" value="{{ old('duration', $programme->duration ?? '') }}" required min="1" max="6"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            @error('duration')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="application_fee" class="block text-sm font-medium text-gray-700">Application Fee (UGX)</label>
                            <input type="number" name="application_fee" id="application_fee" value="{{ old('application_fee', $programme->application_fee ?? '') }}" required min="0"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            @error('application_fee')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="requirements" class="block text-sm font-medium text-gray-700">Entry Requirements</label>
                            <textarea name="requirements" id="requirements" rows="4" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">{{ old('requirements', $programme->requirements ?? '') }}</textarea>
                            @error('requirements')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if(isset($programme))
                        <div>
                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                    {{ old('is_active', $programme->is_active) ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Active Programme
                                </label>
                            </div>
                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <a href="{{ route('admin.programmes.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary ml-3">
                        {{ isset($programme) ? 'Update' : 'Create' }} Programme
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
