<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in {{ $category->name }}</title>
    <!-- Bootstrap 5 -->
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
        .product-list {
            margin-top: 20px;
        }
        .product-item {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .product-item:hover {
            transform: translateY(-10px);
        }
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            color: #3D3F45;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 16px;
            color: #EE4266;
        }
        .btn-buy, .btn-cart {
            display: block;
            width: 100%;
            margin-top: 10px;
        }
        .btn-cart {
            background-color: #3D3F45;
            border-color: #3D3F45;
            color: #fff;
        }
        .btn-cart:hover {
            background-color: #2c2d32;
            border-color: #2c2d32;
        }
    </style>
</head>
<body>

<h1>Products in {{ $category->name }}</h1>

<div class="container product-list">
    <div class="row">
        @forelse($category->products as $product)
            <div class="col-md-4 mb-4">
                <div class="product-item">
                    <!-- Product Image -->
                    <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-image">

                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">${{ number_format($product->price, 2) }}</p>

                    <!-- Buy Now Button -->
                    <a href="#" class="btn btn-primary btn-buy" style="background-color: #EE4266; border-color: #EE4266;">Buy Now</a>

                    <!-- Add to Cart Button -->
                    <form action="#" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-cart">Add to Cart</button>
                    </form>

                </div>
            </div>
        @empty
            <p class="text-center">No products found in this category.</p>
        @endforelse
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
