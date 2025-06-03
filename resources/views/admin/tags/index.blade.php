@extends('layouts.admin')

@section('content')
<div class="container mt-5">
   <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">🏷️ All Tags</h2>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary btn-sm rounded-pill">
    <i class="bi bi-plus-circle"></i> Add Tag
</a>
</div>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="custom-softmax-header text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tag Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td class="text-center fw-semibold">#{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-outline-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.tags.delete', $tag->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tag?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger mb-1">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $tags->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    <style>
        thead.custom-softmax-header th {
            background-color: #EE4266 !important;
            color: white !important;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 20px;
        }

        .btn-sm {
            font-size: 0.875rem;
        }
    </style>

