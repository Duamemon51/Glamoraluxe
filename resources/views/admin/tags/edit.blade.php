@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">✏️ Edit Tag</h2>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>There were some problems:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Tag Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $tag->name) }}" required placeholder="Enter tag name">
                </div>

                 <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-check-circle"></i> Update
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

