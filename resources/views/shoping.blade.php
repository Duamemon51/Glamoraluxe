<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'GLAMORA')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mukta:300,400,700" rel="stylesheet">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @stack('styles') <!-- For pushing additional styles from child views -->
</head>

  <body>
  
  <div class="site-wrap">
    

    <div class="site-navbar bg-white py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>  
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
                   <a href="{{ url('home') }}" class="js-logo-clone">GLAMORA</a>
              <style>.js-logo-clone {
    text-decoration: none;
}
</style>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
        <nav class="site-navigation text-right text-md-center" role="navigation">
          <ul class="site-menu js-clone-nav d-none d-lg-block">
            <li >
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="active"><a href="{{ url('shoping') }}">Shop</a></li>
           
           <li><a href="{{ url('new-arrivals') }}">New Arrivals</a></li>
 <li><a href="{{ url('About-us') }}">About</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
          </ul>
        </nav>
      </div>


          <div class="icons">
             <!-- Search Icon -->
   <a href="#" class="icons-btn d-inline-block js-search-open">
    <span class="icon-search"></span>
</a>
<div class="search-wrap">
    <div class="container">
        <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
        <form action="{{ route('search') }}" method="GET">
            <input type="text" class="form-control" name="query" placeholder="Search products...">
        </form>
    </div>
</div>
     
  @guest
<a href="{{ route('login') }}" class="icons-btn d-inline-block bag">
  <span class="icon-shopping-bag"></span>
  <span class="number">0</span>
</a>
@endguest

@auth
<a href="{{ route('cart.index') }}" class="icons-btn d-inline-block bag">
  <span class="icon-shopping-bag"></span>
  <span class="number">{{ session('cart') ? count(session('cart')) : 0 }}</span>
</a>
@endauth

           
           @guest
  <!-- Guest: Show Login and Register Icons -->
  <a href="{{ route('login') }}" class="icons-btn d-inline-block">
    <i class="fas fa-user-lock"></i>
  </a>
  <a href="{{ route('register') }}" class="icons-btn d-inline-block">
    <span class="icon-user-plus"></span>
  </a>
@else
  <!-- Logged-in User Dropdown -->
  <div class="dropdown d-inline-block">
    <a href="#" class="icons-btn d-inline-flex align-items-center dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
      
      @php
        $name = Auth::user()->name;
        $initials = strtoupper(collect(explode(' ', $name))->map(fn($n) => substr($n,0,1))->join(''));
      @endphp
      <div class="user-initials-circle">
        {{ $initials }}
      </div>

    </a>

    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
      <div class="dropdown-header text-center">
        <strong>{{ Auth::user()->name }}</strong><br>
        <small>{{ Auth::user()->email }}</small>
      </div>


      <div class="dropdown-divider"></div>
@if(Auth::user()->role === 'admin')
  <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
    <i class="fas fa-tachometer-alt" style="margin-right:8px;"></i> Admin Dashboard
  </a>
  <div class="dropdown-divider"></div>
@endif
      <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
  <i class="icon-edit" style="margin-right:8px;"></i> Profile
</a>


      <div class="dropdown-divider"></div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="dropdown-item text-danger">
          <i class="icon-sign-out" style="margin-right:8px;"></i> Logout
        </button>
      </form>
    </div>
  </div>
@endguest
 
 <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>
<style>

.bag .number {
    position: absolute;
    top: 0;
    width: 19px;
    height: 19px;
    border-radius: 50%;
    line-height: 20px;
    color: #fff;
    font-size: 14px;
     font-weight: bold;
    background: #ee4266;
    right: -3px;
}
</style>
    
    <div class="site-blocks-cover inner-page" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-6 ml-auto order-md-2 align-self-start">
            <div class="site-block-cover-content">
            <h2 class="sub-title">#New Summer Collection 2025</h2>
            <h1>Arrivals Sales</h1>
            <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
            </div>
          </div>
          <div class="col-md-6 order-1 align-self-end">
            <img src="images/model_4.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ url('home') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-1">

            <div class="row align">
              <div class="col-md-12 mb-5">
                <div class="float-md-left"><h2 class="text-black h5">Shop All</h2></div>
                <div class="d-flex">
                  <div class="dropdown mr-1 ml-md-auto">
                 
                    
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                      <a class="dropdown-item" href="#">Relevance</a>
                      <a class="dropdown-item" href="#">Name, A to Z</a>
                      <a class="dropdown-item" href="#">Name, Z to A</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Price, low to high</a>
                      <a class="dropdown-item" href="#">Price, high to low</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <!-- Product Listings -->
             <div class="col-lg-9 col-md-8"> 
              <div class="row mb-5">
                  @foreach($products as $product)
                      <div class="col-lg-6 col-md-6 item-entry mb-4">
                          <a href="{{ route('shop-single', $product->id) }}" class="product-item md-height bg-gray d-block">
                              <img src="{{ asset('storage/' . $product->image_url) }}" alt="Image" class="img-fluid">
                          </a>
                          <h2 class="item-title">
                              <a href="{{ route('shop-single', $product->id) }}">{{ $product->name }}</a>
                          </h2>
                          <strong class="item-price">${{ $product->price }}</strong>
          
                        @php
    $rating = $product->rating ?? 0;
@endphp

<div class="star-rating" data-product-id="{{ $product->id }}">
    @for ($i = 1; $i <= 5; $i++)
        <span class="star icon-star2 {{ $i <= $rating ? 'text-warning' : '' }}"
              data-value="{{ $i }}"
              @guest
                  onclick="window.location='{{ route('login') }}'"
              @else
                  onclick="submitRating({{ $product->id }}, {{ $i }})"
              @endguest
        ></span>
    @endfor
</div>

                      
                        
                      </div>
                  @endforeach
              </div>
              
              <style>
                .star {
                    cursor: pointer;
                    font-size: 20px;
                    color: #ccc;
                }
                .star.text-warning {
                    color: gold !important;
                }
            </style>
            
            
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <div class="site-block-27">
                        <ul>
                            @if($products->onFirstPage())
                                <li><span>&lt;</span></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}">&lt;</a></li>
                            @endif
            
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="{{ $products->currentPage() == $page ? 'active' : '' }}">
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
            
                            @if($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}">&gt;</a></li>
                            @else
                                <li><span>&gt;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
          
          </div>

          <div class="col-md-3 order-2 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
                <ul class="list-unstyled mb-0">
                    @foreach($categories as $category)
                        <li class="mb-1">
                            <a href="{{ route('category.products', $category->id) }}" class="d-flex">
                                <span>{{ $category->name }}</span>
                                <span class="text-black ml-auto">({{ $category->products_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div class="border p-4 rounded mb-4">
                <!-- Filter by Price -->
                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                    <div id="slider-range" class="border-primary"></div>
                    <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" 
                           value="₱{{ $minPrice }} - ₱{{ $maxPrice }}" />
                </div>
            
                <!-- Size Filter -->
                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                    @foreach($sizes as $size)
                        <label for="size_{{ $size }}" class="d-flex">
                            <input type="checkbox" id="size_{{ $size }}" class="mr-2 mt-1" 
                                   name="size[]" value="{{ $size }}" 
                                   @if(request()->has('size') && in_array($size, request()->get('size'))) checked @endif> 
                            <span class="text-black">{{ ucfirst($size) }} ({{ App\Models\Product::where('size', $size)->count() }})</span>
                        </label>
                    @endforeach
                </div>
            
                <!-- Color Filter -->
                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                    @foreach($colors as $color)
                        <a href="#" class="d-flex color-item align-items-center">
                            <!-- Circle with dynamic background color -->
                            <span class="color d-inline-block rounded-circle mr-2" style="background-color: {{ $color }}; width: 19px;
    height: 18px;"></span>
                            <!-- Color Name and Count -->
                            <span class="text-black">{{ ucfirst($color) }} ({{ App\Models\Product::where('color', $color)->count() }})</span>
                        </a>
                    @endforeach
                </div>
                
                
            </div>
            

            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="site-section">
      <div class="container">
          <div class="title-section mb-5">
              <h2 class="text-uppercase"><span class="d-block">Discover</span> The Collections</h2>
          </div>
          <div class="row align-items-stretch">
              @foreach($categories as $category)
                  <div class="col-lg-4 mb-4">
                      <div class="product-item sm-height bg-gray">
                          <a href="{{ route('category.products', $category->id) }}" class="product-category">
                              <h5 class="text-dark font-weight-bold">{{ ucfirst($category->name) }}</h5>
                              <!-- Added custom styling for the item count -->
                              <span class="d-block text-muted text-sm mt-2">
                                  <span class="badge badge-pill badge-primary">{{ $category->products_count }} items</span>
                              </span>
                          </a>
  
                          <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid">
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </div>
   <style>body.offcanvas-menu {
  overflow: hidden;
  height: 100vh;
  position: fixed;
  width: 100%;
}.site-wrap {
  height: 100%;
  position: relative;
}

</style>
    
<!-- Add this in your <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<footer style="background: #F8F9FA" class="site-footer custom-border-top">
  <div class="container">
    <div class="row">
      <!-- Promo Section -->
      <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
        <h3 class="footer-heading mb-4">Promo</h3>
        <a href="#" class="block-6">
          <img src="images/about_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
          <h3 class="font-weight-light mb-0">Finding Your Perfect Shirts This Summer</h3>
          <p>Promo from July 15 — 25, 2025</p>
        </a>
      </div>

      <!-- About Me Section, centered -->
      <div class="col-md-6 col-lg-4 ml-auto mb-5 mb-lg-0 d-flex flex-column justify-content-center  about-me">
    
      </div>

      <!-- Contact Info Section with icons -->
      <div class="col-md-6 col-lg-3">
        <div class="block-5 mb-5">
          <h3 class="footer-heading mb-4">Contact Info</h3>
          <ul class="list-unstyled">
            <li><span class="fas fa-map-marker-alt"></span>Sindh, Pakistan</li>
            <li><span class="fas fa-phone-alt"></span> <a href="tel://23923929210">+2 392 3929 210</a></li>
          
            
            <li><span class="fas fa-envelope"></span> <a href="mailto:duamemon51@gmail.com">duamemon51@gmail.com</a></li>
            <li><span class="fab fa-linkedin-in"></span> <a href="https://www.linkedin.com/in/dua-memon-it-professional-093504235" target="_blank" rel="noopener">LinkedIn Profile</a></li>
          </ul>
        </div>

        <!-- Subscribe Form -->
        <div class="block-7">
          <form action="#" method="post">
            <label for="email_subscribe" class="footer-heading">Subscribe</label>
            <div class="form-group d-flex">
              <input type="email" class="form-control py-2" id="email_subscribe" placeholder="Email" required>
              <input type="submit" class="btn btn-sm btn-primary ml-2" value="Send">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="row pt-5 mt-5 text-center">
      <div class="col-md-12">
        <p>
          &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved |
          Website made by <i class="fas fa-heart" style="color:#EE4266;" aria-hidden="true"></i> <strong>Dua Memon</strong>
        </p>
      </div>
    </div>
  </div>

  <style>
    .footer-heading {
      letter-spacing: 2px;
      font-weight: 600;
      font-size: 14px;
      text-transform: uppercase;
      margin-bottom: 20px;
    }
.about-me p {
  color: #555;
  max-width: 320px;
  margin: 0; /* Remove auto to prevent centering */
  font-size: 15px;
  line-height: 1.6;
}

    .block-5 ul li {
      display: flex;
      align-items: center;
      margin-bottom: 12px;
      font-size: 14px;
      color: #444;
    }

    .block-5 ul li span {
      font-size: 20px;
      color: #EE4266;  /* Pink icons */
      margin-right: 10px;
      display: inline-flex;
      align-items: center;
      min-width: 24px;
      justify-content: center;
    }

    .block-5 ul li a {
      color: #444;
      text-decoration: none;
    }

    .block-5 ul li a:hover {
      color: #EE4266;
    }

    .about-me p {
      color: #555; /* Darker for readability */
      max-width: 320px;
      margin: 0 auto;
      font-size: 15px;
      line-height: 1.6;
    }

    /* Subscribe form inputs alignment */
    .block-7 .form-group {
      display: flex;
      gap: 10px;
    }

    .block-7 .form-control {
      flex-grow: 1;
    }
  </style>
</footer>
  </div>
 @auth
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profileModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
          </div>

          <!-- Email (Read-Only) -->
          <div class="mb-3">
            <label for="email" class="form-label">Email (Read-Only)</label>
            <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">New Password (optional)</label>
            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
          </div>

          <!-- Address -->
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2">{{ Auth::user()->address }}</textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endauth

<!-- jQuery (Use only one version) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Local JS Files from public/js -->
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@stack('scripts')

 <script> 
    $(document).ready(function () {
        $('.star-rating .star').on('click', function () {
            var rating = $(this).data('value');
            var productId = $(this).closest('.star-rating').data('product-id');

            @guest
                // Redirect guest to login
                window.location.href = '{{ route("login") }}';
                return;
            @endguest

            // Highlight stars
            $(this).siblings().removeClass('text-warning');
            $(this).addClass('text-warning').prevAll().addClass('text-warning');

            // AJAX call to save rating
            $.ajax({
                url: '{{ route("rate.product") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    rating: rating
                },
                success: function (response) {
                    console.log('Rating updated successfully');
                },
                error: function () {
                    alert('Failed to submit rating');
                }
            });
        });
    });
</script>


    
  </body>
</html>
 