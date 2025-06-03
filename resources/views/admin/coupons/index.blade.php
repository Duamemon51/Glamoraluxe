@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">🎟️ All Coupons</h2>
      <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm rounded-pill">
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
                    <thead class="custom-header text-center">
                        <tr>
                            <th>Code</th>
                            <th>Type</th>
                            <th>Value</th>
                            <th>Expires At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ ucfirst($coupon->type) }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>{{ \Carbon\Carbon::parse($coupon->expires_at)->format('d M, Y') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $coupon->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-outline-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this coupon?')">
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
                    {{ $coupons->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


    <style>
        thead.custom-header th {
            background-color: #EE4266 !important; /* Custom color */
            color: white !important; /* White text */
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

        .badge {
            font-size: 0.875rem;
            padding: 0.25rem 0.75rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 0.875rem;
                word-wrap: break-word; /* Allow word wrapping */
            }

            .container {
                padding-left: 10px;
                padding-right: 10px;
            }

            .btn {
                font-size: 0.75rem;
            }

            .card-body {
                padding: 1rem;
            }

            /* Ensure table scrolls horizontally */
            .table-responsive {
                overflow-x: auto;
            }
        }

        /* For screens less than 660px */
        @media (max-width: 660px) {
            .table th, .table td {
                font-size: 0.75rem; /* Smaller font size for better readability */
                padding: 8px; /* Reduce padding for smaller screens */
            }

            .table td {
                word-wrap: break-word; /* Ensure text wraps in smaller cells */
            }

            .btn {
                font-size: 0.7rem; /* Reduce button font size */
            }

            .btn-outline-warning, .btn-outline-danger {
                font-size: 0.7rem; /* Make action buttons smaller */
                padding: 4px 8px;
            }

            .table-responsive {
                overflow-x: auto; /* Allow horizontal scrolling on small screens */
            }

            .container {
                padding-left: 5px;
                padding-right: 5px;
            }

            /* Hide table actions on mobile if necessary */
            .table td .btn {
                font-size: 0.7rem;
                padding: 4px 8px;
            }
        }

        /* For very small screens (below 480px) */
        @media (max-width: 480px) {
            .table th, .table td {
                font-size: 0.7rem;
                padding: 6px;
            }

            .btn {
                font-size: 0.65rem; /* Further reduce button size */
                padding: 3px 6px;
            }

            .table td {
                padding: 6px;
            }
        }
    </style>

