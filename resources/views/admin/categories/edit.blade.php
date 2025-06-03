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
            <h4 class="mb-0"><i class="bi bi-pencil-square"></i>✏️ Edit Category</h4>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Category Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Category Image:</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @if($category->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="120" class="rounded shadow">
                        </div>
                    @endif
                </div>
<div class="d-flex justify-content-start gap-2">
    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 py-1">
        <i class="bi bi-check-circle"></i> Update
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
</style>

