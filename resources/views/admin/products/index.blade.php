@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">🛒 Product List</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm rounded-pill">
    <i class="bi bi-plus-circle"></i> Add Product
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
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        
        <th>Category</th>
        <th>Size</th>
        <th>Color</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($products as $product)
    <tr>
        <td class="text-center fw-bold">{{ $product->id }}</td>
        
        {{-- Image column --}}
        <td class="text-center">
            @if($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" width="60" height="60" class="rounded">
            @else
                <span class="text-muted">No image</span>
            @endif
        </td>

        <td>{{ $product->name }}</td>

      

        <td>{{ $product->category->name }}</td>
        <td>{{ $product->size }}</td>
        <td>{{ $product->color }}</td>
        <td>${{ number_format($product->price, 2) }}</td>
        <td class="text-center">{{ $product->stock_quantity }}</td>
        <td class="text-center">
            @php
                $statusColors = [
                    'in_stock' => 'success',
                    'out_of_stock' => 'danger',
                ];
                $statusBadge = $statusColors[$product->status] ?? 'secondary';
            @endphp
            <span class="badge bg-{{ $statusBadge }}">
                {{ ucfirst(str_replace('_', ' ', $product->status)) }}
            </span>
        </td>
        <td class="text-center">
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning me-1 mb-1">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this product?')">
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

                <div class="mt-3">
                    {{ $products->links('pagination::bootstrap-5') }}
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

    .btn {
        border-radius: 20px;
    }

    .btn-sm {
        font-size: 0.875rem;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .table th, .table td {
            padding: 0.75rem;
            font-size: 0.875rem;
        }

        .btn-sm {
            font-size: 0.75rem;
        }
    }
</style>
