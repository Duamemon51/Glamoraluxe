@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Message Details</h2>

    <div class="card">
        <div class="card-header">
            From: {{ $message->first_name }} {{ $message->last_name }} ({{ $message->email }})
        </div>
        <div class="card-body">
            <h5 class="card-title">Subject: {{ $message->subject ?? 'No Subject' }}</h5>
            <p class="card-text">{{ $message->message }}</p>
            <a href="{{ route('admin.contacts') }}" class="btn btn-secondary mt-3">Back to Messages</a>
        </div>
    </div>
</div>
@endsection
