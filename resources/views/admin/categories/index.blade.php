@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
            <h2 class="fw-bold text-dark mb-3 mb-md-0">🛍️ All Categories</h2>
              <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm rounded-pill">
    <i class="bi bi-plus-circle"></i> Add Category
</a>

        </div>
       

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        @endif

        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="custom-softmax-header" style="background: #EE4266">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-fluid" style="max-width: 80px;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-1">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    thead.custom-softmax-header th {
        background-color: #EE4266 !important;
        color: white !important;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn {
        border-radius: 20px;
    }

    .btn-sm {
        font-size: 0.875rem;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .d-flex.flex-md-row {
            flex-direction: column !important;
        }

        .btn.w-md-auto {
            width: 100% !important;
            margin-top: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .d-flex.flex-sm-row {
            flex-direction: column !important;
        }

        .d-flex.flex-sm-row .btn {
            width: 100%;
        }
    }
</style>
@endpush

