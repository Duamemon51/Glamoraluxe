@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    <!-- Back Button -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>

    <!-- Product Card -->
    <div class="card shadow border-0">
        <div class="card-header bg-pink text-white">
            <h4 class="mb-0"><i class="bi bi-plus-square"></i> ✨ Add New Product</h4>
        </div>


        <div class="card-body bg-light">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- Product Description -->
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>

                <!-- Category Dropdown -->
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Category</label>
                    <select name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label for="tags" class="form-label fw-bold">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" placeholder="Add tags (comma-separated)">
                </div>

                <!-- Product Size -->
                <div class="mb-3">
                    <label for="size" class="form-label fw-bold">Size</label>
                    <input type="text" class="form-control" id="size" name="size">
                </div>

                <!-- Product Color -->
                <div class="mb-3">
                    <label for="color" class="form-label fw-bold">Color</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>

                <!-- Product Price -->
                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>

                <!-- Stock Quantity -->
                <div class="mb-3">
                    <label for="stock_quantity" class="form-label fw-bold">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                </div>

                <!-- Product Image Upload -->
                <div class="mb-3">
                    <label for="image_url" class="form-label fw-bold">Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url" required>
                </div>

                <!-- Is New -->


                <!-- Product Status -->
                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="in_stock">In Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>

                <!-- Submit Button -->
              <!-- Submit Button -->
<div class="d-flex justify-content-start mt-4">
    <button type="submit" class="btn btn-success rounded-pill btn-sm-custom">
        <i class="bi bi-check-circle"></i> Save
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
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.querySelector('input[name="tags"]');

        const tagify = new Tagify(input, {
            delimiters: " ", // ← THIS makes space the trigger for creating a tag
            dropdown: {
                enabled: 1,
                maxItems: 10,
                closeOnSelect: false
            }
        });

        // Optional: Fetch tag suggestions dynamically
        tagify.on('input', function(e){
            let value = e.detail.value;

            fetch(`/admin/tags/suggestions?search=${value}`)
                .then(res => res.json())
                .then(suggestions => {
                    tagify.settings.whitelist = suggestions;
                    tagify.dropdown.show.call(tagify, value); // Show suggestions
                });
        });
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

