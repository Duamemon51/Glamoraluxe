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
   



        <!-- Shopping Bag Icon -->
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
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="#">Click here</a> to login
            </div>
          </div>
        </div>
        <form action="{{ route('checkout.place') }}" method="POST" class="p-5 bg-white">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <h2 class="h3 mb-3 text-black">Billing Details</h2>
    
              <div class="form-group">
                <label for="first_name">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control" id="first_name" required>
              </div>
    
              <div class="form-group">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control" id="last_name" required>
              </div>
    
              <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" class="form-control" id="company_name">
              </div>
    
              <div class="form-group">
                <label for="country">Country <span class="text-danger">*</span></label>
                <input type="text" name="country" class="form-control" id="country" required>
              </div>
    
              <div class="form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" id="address" required>
              </div>
    
              <div class="form-group">
                <label for="apartment">Apartment, suite, unit, etc. (optional)</label>
                <input type="text" name="apartment" class="form-control" id="apartment">
              </div>
    
              <div class="form-group">
                <label for="state">State / Province <span class="text-danger">*</span></label>
                <input type="text" name="state" class="form-control" id="state" required>
              </div>
    
              <div class="form-group">
                <label for="postal_code">Postal Code <span class="text-danger">*</span></label>
                <input type="text" name="postal_code" class="form-control" id="postal_code" required>
              </div>
    
              <div class="form-group">
                <label for="email">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" id="email" required>
              </div>
    
              <div class="form-group">
                <label for="phone">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" id="phone" required>
              </div>
    
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="ship" name="ship_to_different_address" onclick="document.getElementById('shipping-fields').style.display = this.checked ? 'block' : 'none';">
                <label class="form-check-label" for="ship">Ship to a different address?</label>
              </div>
    
              <div id="shipping-fields" style="display:none;">
                <h4 class="text-black">Shipping Details</h4>
    
                @foreach (['first_name', 'last_name', 'company_name', 'country', 'address', 'apartment', 'state', 'postal_code', 'email', 'phone'] as $field)
                  <div class="form-group">
                    <label for="shipping_{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                    <input type="{{ $field == 'email' ? 'email' : 'text' }}" name="shipping_{{ $field }}" class="form-control" id="shipping_{{ $field }}">
                  </div>
                @endforeach
              </div>
    
              <div class="form-group">
                <label for="order_notes">Order Notes</label>
                <textarea name="order_notes" id="order_notes" class="form-control" placeholder="Write your notes here..."></textarea>
              </div>
    
              <div class="form-group">
                <label for="coupon_code">Coupon Code</label>
                <input type="text" name="coupon_code" class="form-control" id="coupon_code" placeholder="Coupon Code">
              </div>
    
              @php
              $discount = session('discount_amount', 0);
              $total = $subtotal - $discount;
            @endphp
            
            <input type="hidden" name="total_price" value="{{ $total }}">
            
            </div>
    
            <div class="col-md-6">
              <h2 class="h3 mb-3 text-black">Your Order</h2>
              <div class="p-3 p-lg-5 border">
    
                @php
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += $item->price * $item->quantity;
                }
                $discount = session('discount_amount', 0);
                $total = $subtotal - $discount;
            @endphp
            
            <table class="table site-block-order-table mb-5">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cartItems as $item)
                  <tr>
                    <td>{{ $item->name }} <strong class="mx-2">x</strong> {{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                  </tr>
                @endforeach
            
                <tr>
                  <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                  <td class="text-black">${{ number_format($subtotal, 2) }}</td>
                </tr>
            
                @if($discount > 0)
                <tr>
                  <td class="text-black font-weight-bold text-success"><strong>Discount</strong></td>
                  <td class="text-black text-success">- ${{ number_format($discount, 2) }}</td>
                </tr>
                @endif
            
                <tr>
                  <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                  <td class="text-black font-weight-bold"><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
              </tbody>
            </table>
            
         
               !-- Payment Method Section -->

                <div class="container my-3">
                  <div class="text-center mb-2">
                    <h5 class="fw-bold text-light">Payment Method</h5>
                    <p class="text-muted small">Choose your payment option</p>
                  </div>
                <!-- Stripe Card Element -->
<div id="stripe-card-element" class="form-group d-none">
  <label for="card-element">Card Details</label>
  <div id="card-element" class="form-control p-2"></div>
  <div id="card-errors" class="text-danger mt-2" role="alert"></div>
</div>

                  <!-- Payment Options -->
                
                  <div class="d-flex justify-content-center gap-4">
                    <div class="payment-option p-2 text-center cursor-pointer border rounded" data-method="cod">
                      <div class="fs-4 text-light">&#128181;</div>
                      <p class="mt-1 mb-0 small">Cash on Delivery</p>
                    </div>
                    <div class="payment-option p-2 text-center cursor-pointer border rounded" data-method="stripe">
                      <div class="fs-4 text-light">&#128179;</div>
                      <p class="mt-1 mb-0 small">Pay with Stripe</p>
                    </div>
                  </div>
                
                  <!-- Action Buttons -->
                
                  <div class="mt-2" id="cod-button">
                    <button type="submit" class="btn btn-pink w-100 py-1">Place Order</button>
                  </div>
                  <div class="mt-2 d-none" id="stripe-button">
                    <button type="submit" class="btn btn-pink w-100 py-1">Pay with Stripe</button>
                  </div>
                
                  <!-- Hidden Inputs -->
                
                  <input type="hidden" name="payment_method" id="payment_method" value="cod">
                  <input type="hidden" name="total_price" value="{{ $total }}">
                </div>
                
                <!-- Custom Styles for #EE4266 Theme -->
                
                <style>
                  body {
                    background-color: #fafafa;
                    color: #212529;
                  }
                
                  .payment-option {
                    background-color: #ffffff;
                    border: 1px solid #EE4266;
                    border-radius: 8px;
                    padding: 10px;
                    width: 160px;
                    text-align: center;
                    transition: background-color 0.3s ease, box-shadow 0.3s ease;
                  }
                
                  .payment-option:hover {
                    background-color: #fbe1e6;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                  }
                
                  .payment-option.active {
                    background-color: #EE4266;
                    color: white;
                  }
                
                  .payment-option p {
                    font-size: 0.8rem;
                    margin: 0;
                  }
                
                  .btn-pink {
                    background-color: #EE4266;
                    border: none;
                    font-size: 0.85rem;
                    font-weight: 500;
                    padding: 10px;
                    border-radius: 6px;
                  }
                
                  .btn-pink:hover {
                    background-color: #d81b60;
                  }
                </style>
                
                <!-- Toggle Script -->
                
          





              </div>
            </div>
          </div>
        </form>
<!-- Bootstrap JS (required for collapse) -->
<script src="https://js.stripe.com/v3/"></script>
<script>
  // Show or hide shipping fields based on checkbox
  document.getElementById('ship').addEventListener('change', function () {
      document.getElementById('shipping-fields').style.display = this.checked ? 'block' : 'none';
  });
  
  

 
                  document.querySelectorAll('.payment-option').forEach(option => {
                    option.addEventListener('click', function () {
                      document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
                      this.classList.add('active');
                
                      const method = this.getAttribute('data-method');
                      document.getElementById('payment_method').value = method;
                
                      document.getElementById('cod-button').classList.toggle('d-none', method !== 'cod');
                      document.getElementById('stripe-button').classList.toggle('d-none', method !== 'stripe');
                    });
                  });
                </script>
                



<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
  }

  .checkout-form {
    max-width: 900px;
    margin: 40px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .checkout-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  .checkout-form h4 {
    margin-top: 20px;
    color: #333;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
    display: block;
  }

  .form-group input, .form-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
    color: #333;
  }

  .form-group textarea {
    height: 100px;
  }

  .form-group input[type="checkbox"] {
    width: auto;
    margin-right: 10px;
  }

  .form-group button {
    padding: 12px;
    width: 100%;
    background-color: #EE4266;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
  }

  .form-group button:hover {
    background-color: #d73758;
  }

  .text-danger {
    color: red;
  }

  .checkout-form .form-group input:focus, .checkout-form .form-group textarea:focus {
    border-color: #EE4266;
    outline: none;
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