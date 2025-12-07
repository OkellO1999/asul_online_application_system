@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">Application Status</h1>

        @if(session('info'))
            <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('info') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            @if(!$application)
                <!-- No Application Found -->
                <div class="px-4 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No application found</h3>
                    <p class="mt-1 text-sm text-gray-500">You haven't submitted any applications yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('applicant.apply') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Start Application
                        </a>
                    </div>
                </div>
            @else
                <!-- Application Status Details -->
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Application #{{ $application->application_number }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Current status and timeline
                    </p>
                </div>

                <div class="border-t border-gray-200">
                    <dl>
                        <!-- Basic Information -->
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Programme Applied</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $application->programme->name }} ({{ $application->programme->code }})
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Application Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-yellow-100 text-yellow-800',
                                        'submitted' => 'bg-blue-100 text-blue-800',
                                        'payment_pending' => 'bg-orange-100 text-orange-800',
                                        'under_review' => 'bg-purple-100 text-purple-800',
                                        'shortlisted' => 'bg-indigo-100 text-indigo-800',
                                        'admitted' => 'bg-green-100 text-green-800',
                                        'not_admitted' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusText = [
                                        'draft' => 'Draft',
                                        'submitted' => 'Submitted',
                                        'payment_pending' => 'Payment Pending',
                                        'under_review' => 'Under Review',
                                        'shortlisted' => 'Shortlisted for Interview',
                                        'admitted' => 'Admitted',
                                        'not_admitted' => 'Not Admitted',
                                    ];
                                @endphp
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColors[$application->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusText[$application->status] ?? ucfirst($application->status) }}
                                </span>
                            </dd>
                        </div>

                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Application Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $application->created_at->format('F d, Y h:i A') }}
                            </dd>
                        </div>

                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $application->updated_at->format('F d, Y h:i A') }}
                            </dd>
                        </div>

                        <!-- Payment Information -->
                        @if($application->payments->count() > 0)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Payment Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @php
                                    $payment = $application->payments->first();
                                    $paymentStatusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $paymentStatusColors[$payment->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                                @if($payment->transaction_id)
                                    <p class="mt-1 text-sm text-gray-600">Transaction ID: {{ $payment->transaction_id }}</p>
                                @endif
                            </dd>
                        </div>
                        @endif

                        <!-- Notes from Registrar -->
                        @if($application->notes)
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Admin Notes</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="bg-gray-50 p-3 rounded border">
                                    {{ $application->notes }}
                                </div>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Status Timeline -->
                <div class="px-4 py-5 sm:px-6">
                    <h4 class="text-md font-medium text-gray-900 mb-4">Application Timeline</h4>
                    <div class="flow-root">
                        <ul class="-mb-8">
                            @php
                                $timeline = [
                                    ['status' => 'submitted', 'label' => 'Application Submitted', 'date' => $application->created_at],
                                ];

                                if($application->payments->count() > 0) {
                                    $payment = $application->payments->first();
                                    $timeline[] = ['status' => 'payment', 'label' => 'Payment ' . ucfirst($payment->status), 'date' => $payment->created_at];
                                }

                                if($application->status !== 'submitted' && $application->status !== 'payment_pending') {
                                    $timeline[] = ['status' => $application->status, 'label' => $statusText[$application->status] ?? ucfirst($application->status), 'date' => $application->updated_at];
                                }

                                // Sort timeline by date
                                usort($timeline, function($a, $b) {
                                    return $a['date'] <=> $b['date'];
                                });
                            @endphp

                            @foreach($timeline as $index => $item)
                            <li>
                                <div class="relative pb-8">
                                    @if($index < count($timeline) - 1)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            @php
                                                $iconColors = [
                                                    'submitted' => 'bg-blue-500',
                                                    'payment' => $payment->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500',
                                                    'under_review' => 'bg-purple-500',
                                                    'shortlisted' => 'bg-indigo-500',
                                                    'admitted' => 'bg-green-500',
                                                    'not_admitted' => 'bg-red-500',
                                                ];
                                            @endphp
                                            <span class="h-8 w-8 rounded-full {{ $iconColors[$item['status']] ?? 'bg-gray-400' }} flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $item['label'] }}</p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time datetime="{{ $item['date']->format('Y-m-d') }}">
                                                    {{ $item['date']->format('M d, Y') }}
                                                </time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Next Steps -->
                @if($application->status === 'payment_pending')
                <div class="bg-yellow-50 border-t border-yellow-200 px-4 py-5 sm:px-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Payment Required</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>Your application is pending payment. Please complete the payment to proceed with the review.</p>
                                <div class="mt-3">
                                    <a href="{{ route('applicant.payment', $application) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-yellow-800 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        Complete Payment
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($application->status === 'admitted')
                <div class="bg-green-50 border-t border-green-200 px-4 py-5 sm:px-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 10l2.293-2.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Congratulations!</h3>
                            <div class="mt-2 text-sm text-green-700">
                                <p>You have been admitted to {{ $application->programme->name }}. You will receive an official admission letter soon with further instructions.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($application->status === 'not_admitted')
                <div class="bg-red-50 border-t border-red-200 px-4 py-5 sm:px-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Application Not Successful</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <p>We regret to inform you that your application was not successful for this intake. You may apply again in the next intake period.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>

        <!-- Actions -->
        @if($application)
        <div class="mt-6 flex justify-between">
            <a href="{{ route('applicant.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                Back to Dashboard
            </a>
            @if($application->status === 'submitted' || $application->status === 'payment_pending')
                <a href="{{ route('applicant.payment', $application) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Complete Payment
                </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection
