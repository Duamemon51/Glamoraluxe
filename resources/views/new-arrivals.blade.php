@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">🌟 New Arrivals</h2>

    <div class="row">
      @forelse($newProducts as $product)
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
          
          {{-- Full Image --}}
          <div class="w-100" style="height: 350px; overflow: hidden;">
           <img src="{{ asset('storage/' . $product->image_url) }}"
     alt="{{ $product->name }}"
     class="img-fluid w-100"
     style="height: 350px; object-fit: contain; object-position: top; background-color: #fff;">

          </div>

          {{-- Product Info --}}
          <div class="card-body text-center">
            <h5 class="card-title text-dark">{{ $product->name }}</h5>
            <p class="mb-1"><strong>Size:</strong> {{ $product->size }}</p>
            <p class="mb-2"><strong>Color:</strong> {{ ucfirst($product->color) }}</p>
            <h6 class="text-danger fw-bold mb-3">${{ number_format($product->price, 2) }}</h6>
            <a href="{{ route('shop-single', $product->id) }}" class="btn btn-outline-danger px-4">Buy Now</a>
          </div>

        </div>
      </div>
      @empty
      <div class="col-12">
        <p class="text-center text-muted">No new arrivals available at the moment.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
