<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #EE4266;
            margin-top: 30px;
        }
        .category-list {
            margin-top: 20px;
        }
        .category-item {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .category-item:hover {
            transform: translateY(-10px);
        }
        .category-name {
            font-size: 18px;
            font-weight: bold;
            color: #3D3F45;
        }
        .product-count {
            color: #EE4266;
            font-size: 16px;
        }
        .category-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .view-products-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Product Categories</h1>
    <div class="container category-list">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="category-item">
                        <!-- Category Image -->
                        <img src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}" class="category-image" style="width: 100%; height: auto;">

                       
                        <p class="category-name">{{ $category->name }}</p>
                        <p class="product-count">{{ $category->products->count() }} Products</p>

                        <!-- View Products Button -->
                        <a href="{{ route('admin.products.home', ['category' => $category->id]) }}" class="btn btn-primary view-products-btn">View Products</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
