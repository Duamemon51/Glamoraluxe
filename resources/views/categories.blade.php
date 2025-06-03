<div class="site-section">
    <div class="container">
        <div class="title-section mb-5">
            <h2 class="text-uppercase"><span class="d-block">Discover</span> The Categories</h2>
        </div>
        <div class="row align-items-stretch">
            @foreach ($categories as $category)
                <div class="col-lg-{{ $loop->index == 0 ? '8' : '4' }}">
                    <div class="product-item sm-height full-height bg-gray">
                        <a href="{{ route('category.show', $category->id) }}" class="product-category">
                            {{ $category->name }} <span>{{ $category->items_count }} items</span>
                        </a>
                        <img src="{{ asset('images/' . $category->image) }}" alt="Image" class="img-fluid">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
