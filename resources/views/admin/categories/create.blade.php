@extends('layouts.admin')

@section('content')
<div class="container mt-5">
     <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>
    <div class="card shadow border-0">
        <div class="card-header bg-pink text-white">
            <h4 class="mb-0"><i class="bi bi-folder-plus"></i> Add New Category</h4>
        </div>

        <div class="card-body bg-light">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Category Image (optional)</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

    <div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 py-1">
        <i class="bi bi-plus-circle"></i> Add
    </button>
 
</div>


            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .bg-pink {
        background-color: #EE4266 !important;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        border-radius: 0 0 15px 15px;
    }

    .btn {
        font-weight: 500;
    }
</style>
