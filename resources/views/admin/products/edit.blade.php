@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <!-- Back Button -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left-circle"></i> Back
    </a>
</div>

    <div class="card shadow border-0">
        <div class="card-header bg-pink text-white">
            <h4 class="mb-0"><i class="bi bi-pencil-square"></i> ✏️ Edit Product</h4>
        </div>
        <div class="card-body bg-light">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $product->description }}</textarea>
                </div>

                <!-- Category Dropdown -->
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label for="tags" class="form-label fw-bold">Tags</label>
                    <input name="tags" id="tags" value="{{ implode(',', $tags) }}" class="form-control" placeholder="Add tags (comma-separated)">
                </div>

                <!-- Product Size -->
                <div class="mb-3">
                    <label for="size" class="form-label fw-bold">Size</label>
                    <input type="text" class="form-control" id="size" name="size" value="{{ $product->size }}">
                </div>

                <!-- Product Color -->
                <div class="mb-3">
                    <label for="color" class="form-label fw-bold">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ $product->color }}">
                </div>

                <!-- Product Price -->
                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
                </div>
                <!-- Is New Product -->
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_new" name="is_new" {{ $product->is_new ? 'checked' : '' }}>
    <label class="form-check-label fw-bold" for="is_new">Mark as New Arrival</label>
</div>

<!-- Is Featured Product -->
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="is_feature" name="is_feature" {{ $product->is_feature ? 'checked' : '' }}>
    <label class="form-check-label fw-bold" for="is_feature">Feature this Product</label>
</div>

                <!-- Stock Quantity -->
                <div class="mb-3">
                    <label for="stock_quantity" class="form-label fw-bold">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $product->stock_quantity }}" required>
                </div>

                <!-- Product Image Upload -->
               <div class="mb-3">
    <label for="image_url" class="form-label fw-bold">Change Image</label>
    <input type="file" class="form-control" id="image_url" name="image_url">
    @if($product->image_url)
        <small class="text-muted">Current Image: <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" width="100"></small>
    @endif
</div>


                <!-- Product Status -->
                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="in_stock" {{ $product->status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="out_of_stock" {{ $product->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <!-- Update Button -->
                <div class="d-flex justify-content-start mt-4">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                  
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<!-- Tagify JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.querySelector('input[name=tags]');
        if (input) {
            new Tagify(input);
        }
    });
</script>



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
        background-color: #EE4266;
    }

    .card-body {
        border-radius: 0 0 15px 15px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .btn-outline-secondary {
        color: #333;
        border-color: #333;
    }

    .btn-outline-secondary:hover {
        background-color: #333;
        color: #fff;
    }

    .rounded-pill {
        border-radius: 50px;
    }

    .shadow {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }
</style>
