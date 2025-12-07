@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2>Applicant Dashboard</h2>
    <p>Welcome, {{ Auth::user()->name }}!</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Application Status
        </div>
        <div class="card-body">
            @if($application)
                <p><strong>Programme:</strong> {{ $application->programme->name }}</p>
                <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $application->status)) }}</p>
            @else
                <p>You have not submitted an application yet.</p>
                <a href="{{ route('application.create') }}" class="btn btn-primary">Apply Now</a>
            @endif
        </div>
    </div>
</div>
@endsection
