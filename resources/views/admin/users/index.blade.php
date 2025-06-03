@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">👥 All Users</h2>
       <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm rounded-pill">
    <i class="bi bi-plus-circle"></i> Add Tag
</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="custom-softmax-header" style="background: #EE4266">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Avatar</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
    @if ($user->id !== Auth::id())
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>{{ $user->phone ?? '—' }}</td>
            <td>
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="img-fluid rounded-circle" style="max-width: 50px;">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </td>
            <td>
                <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endif
@endforeach

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    
    /* User Avatar */
    .img-fluid {
        border-radius: 50%;
    }

    /* Table Hover Effect */
    .table-hover tbody tr:hover {
        background-color: #F1F1F1;
    }

    /* Adjusted Button Styling */
    .btn-outline-warning, .btn-outline-danger {
        border-width: 1px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-warning:hover, .btn-outline-danger:hover {
        background-color: #EE4266;
        color: white;
    }

    /* Pagination Styling */
    .pagination .page-item.active .page-link {
        background-color: #EE4266;
        border-color: #EE4266;
        color: white;
    }
</style>
@endpush
