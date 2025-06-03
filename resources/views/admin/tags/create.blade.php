{{-- resources/views/admin/tags/create.blade.php --}}

@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">🏷️ Add New Tag</h2>
       <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>

    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tag Name</label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter tag name">
                </div>

                 <button type="submit" class="btn btn-success rounded-pill btn-sm-custom">
        <i class="bi bi-check-circle"></i> Save
    </button>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .btn {
        border-radius: 20px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(238, 66, 102, 0.25);
        border-color: #EE4266;
    }
</style>

