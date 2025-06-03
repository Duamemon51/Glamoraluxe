

@section('content')
<div class="container">
    <h2>Add to Cart</h2>

    <form action="{{ route('cart.add') }}" method="POST">
        @csrf

        {{-- Product ID --}}
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name:</label>
            <input type="text" class="form-control" id="product_name" value="{{ $product->name }}" readonly>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" readonly>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
</div>
@endsection
