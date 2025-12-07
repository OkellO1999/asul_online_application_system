@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Complete Payment</h1>

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Payment Details</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Application Number</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->application_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Programme</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $application->programme->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Application Fee</p>
                            <p class="mt-1 text-lg font-semibold text-primary">UGX {{ number_format($application->programme->application_fee) }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Payment Status</p>
                            <p class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('applicant.payment.process', $application) }}">
                    @csrf

                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Select Payment Method</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="radio" id="mtn_mobile_money" name="method" value="mtn_mobile_money" checked
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                <label for="mtn_mobile_money" class="ml-3 block text-sm font-medium text-gray-700">
                                    MTN Mobile Money
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="airtel_money" name="method" value="airtel_money"
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                <label for="airtel_money" class="ml-3 block text-sm font-medium text-gray-700">
                                    Airtel Money
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" id="bank" name="method" value="bank"
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                <label for="bank" class="ml-3 block text-sm font-medium text-gray-700">
                                    Bank Transfer
                                </label>
                            </div>
                        </div>
                        @error('method')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6" id="phone_number_field">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Enter your mobile money number">
                        @error('phone_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Important:</strong> After submitting, you will receive a payment request on your phone. Please complete the payment to finalize your application.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('applicant.dashboard') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Cancel
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Proceed to Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h4 class="text-md font-medium text-gray-900 mb-4">Bank Payment Details</h4>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Bank Name</p>
                        <p class="mt-1 text-sm text-gray-900">Centenary Bank</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Account Name</p>
                        <p class="mt-1 text-sm text-gray-900">All Saints University - Lango</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Account Number</p>
                        <p class="mt-1 text-sm text-gray-900">3100045879</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Branch</p>
                        <p class="mt-1 text-sm text-gray-900">Lira Main Branch</p>
                    </div>
                </div>
                <p class="mt-4 text-sm text-gray-500">
                    For bank transfers, please include your application number as the reference.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneField = document.getElementById('phone_number_field');
        const phoneInput = document.getElementById('phone_number');
        const paymentMethods = document.querySelectorAll('input[name="method"]');

        function togglePhoneField() {
            const selectedMethod = document.querySelector('input[name="method"]:checked').value;
            if (selectedMethod === 'mtn_mobile_money' || selectedMethod === 'airtel_money') {
                phoneField.style.display = 'block';
                phoneInput.setAttribute('required', 'required');
            } else {
                phoneField.style.display = 'none';
                phoneInput.removeAttribute('required');
            }
        }

        paymentMethods.forEach(method => {
            method.addEventListener('change', togglePhoneField);
        });

        togglePhoneField(); // Initial check
    });
</script>
@endsection
