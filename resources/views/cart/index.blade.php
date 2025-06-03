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
            <li class="active">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li><a href="{{ url('shoping') }}">Shop</a></li>
           
           <li><a href="{{ url('new-arrivals') }}">New Arrivals</a></li>
 <li><a href="{{ url('About-us') }}">About</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
          </ul>
        </nav>
      </div>


          <div class="icons">
             <!-- Search Icon -->
   



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
<style>/* Hide only the heart and shopping bag icons on screens smaller than 340px */
/* Hide the heart icon and shopping bag icon (including the number) on screens smaller than 340px */


</style>
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
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post" action="{{ route('cart.update') }}">
            @csrf
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cartItems as $item)
                  <tr>
                    <td class="product-thumbnail">
                      @if ($item->product && $item->product->image_url)
                        <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="Product Image" class="img-fluid" width="100">
                      @else
                        <span>No image</span>
                      @endif
                    </td>
    
                    <td class="product-name">
                      <h2 class="h5 text-black">{{ $item->product->name }}</h2>
                    </td>
    
                    <td>${{ number_format($item->price, 2) }}</td>
    
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary js-btn-minus" type="button" onclick="decrementQuantity({{ $item->id }})">−</button>
                        </div>
                        <input type="text" id="quantity-{{ $item->id }}" name="quantities[{{ $item->id }}]" class="form-control text-center" value="{{ $item->quantity }}">
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary js-btn-plus" type="button" onclick="incrementQuantity({{ $item->id }})">+</button>
                        </div>
                      </div>
                    </td>
    
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
    
                    <td>
                      <a href="{{ route('cart.remove', $item->id) }}" class="btn btn-primary height-auto btn-sm">X</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
         
   
    
              <div class="text-right mt-3">
              
            
                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-success">Update Cart</button>
                    </div>
                  </form>
            </div>
            
            <div class="col-md-6">
              <a href="{{ route('shoping') }}" class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</a>
          </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm px-4" id="apply-coupon">Apply Coupon</button>
              </div>
            </div>
            
            <div id="coupon-message" class="mt-3"></div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
              $(document).ready(function() {
                $('#apply-coupon').click(function(e) {
                  e.preventDefault();
            
                  var couponCode = $('#coupon').val();
                  var cartTotal = 100; // You should dynamically set this to the current cart total
            
                  if (couponCode) {
                    $.ajax({
                      url: '/apply-coupon',
                      method: 'POST',
                      data: {
                        coupon_code: couponCode,
                        cart_total: cartTotal,
                        _token: '{{ csrf_token() }}' // Ensure CSRF token is included
                      },
                      success: function(response) {
                        if (response.discount) {
                          $('#coupon-message').html(`
                            <div class="alert alert-success">
                              Coupon applied! You saved %${response.discount}.
                            </div>
                          `);
                        } else {
                          $('#coupon-message').html(`
                            <div class="alert alert-danger">
                              ${response.error}
                            </div>
                          `);
                        }
                      },
                      error: function(xhr) {
                        $('#coupon-message').html(`
                          <div class="alert alert-danger">
                            Something went wrong. Please try again.
                          </div>
                        `);
                      }
                    });
                  } else {
                    $('#coupon-message').html(`
                      <div class="alert alert-warning">
                        Please enter a coupon code.
                      </div>
                    `);
                  }
                });
              });
            </script>
            
          </div>
          </div>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6">
                <div class="row">
                  <div class="col-12 border-bottom mb-4">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
          
                <div class="row mb-3">
                  <div class="col-6">
                    <span class="text-black">Subtotal</span>
                  </div>
                  <div class="col-6 text-right">
                    <strong class="text-black">${{ number_format($subtotal, 2) }}</strong>
                  </div>
                </div>
          
                <!-- Show discount/savings here -->
                <div id="coupon-savings" class="row mb-3" style="display: none;">
                  <div class="col-6">
                    <span class="text-black">You saved</span>
                  </div>
                  <div class="col-6 text-right">
                    <strong class="text-success" id="saved-amount"></strong>
                  </div>
                </div>
          
                <div class="row mb-4">
                  <div class="col-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-6 text-right">
                    <strong class="text-black" id="final-total">${{ number_format($total, 2) }}</strong>
                  </div>
                </div>
          
                <div class="row">
                  <div class="col-12">
                    <a href="{{ route('checkout.place') }}" class="btn btn-primary btn-lg btn-block">Proceed To Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
         <script>
$(document).ready(function() {
  $('#apply-coupon').click(function(e) {
    e.preventDefault();

    var couponCode = $('#coupon').val();
    var cartTotal = {{ $total }}; // Pass total from PHP

    if (couponCode) {
      $.ajax({
        url: '/apply-coupon',
        method: 'POST',
        data: {
          coupon_code: couponCode,
          cart_total: cartTotal,
          _token: '{{ csrf_token() }}'
        },
        success: function(response) {
          if (response.discount) {
            // Show savings
            $('#coupon-savings').show();
            $('#saved-amount').text('$' + response.discount.toFixed(2));

            // Update total
            var newTotal = cartTotal - response.discount;
            $('#final-total').text('$' + newTotal.toFixed(2));
          } else if (response.error) {
            // If no discount but error exists
            $('#coupon-savings').hide();
            $('#final-total').text('$' + cartTotal.toFixed(2));
            alert(response.error);
          }
        },
        error: function(xhr) {
          let message = 'Something went wrong. Please try again.';

          // Check if the backend sent a JSON error
          if (xhr.responseJSON && xhr.responseJSON.error) {
            message = xhr.responseJSON.error;
          }

          alert(message);
        }
      });
    } else {
      alert('Please enter a coupon code.');
    }
  });
});
</script>

          
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
  <!-- Bootstrap JS Bundle (includes Popper) -->
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
    
  <script>
    function decrementQuantity(id) {
        const input = document.getElementById(id);
        let value = parseInt(input.value) || 1;
        if (value > 1) input.value = value - 1;
    }

    function incrementQuantity(id) {
        const input = document.getElementById(id);
        let value = parseInt(input.value) || 1;
        input.value = value + 1;
    }
</script>
<!-- CDN Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Local JS Files (served from public/js directory) -->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/aos.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@stack('scripts') <!-- Allows pushing custom scripts from child views -->

    
  </body>
</html>