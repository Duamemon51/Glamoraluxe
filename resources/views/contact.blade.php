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
            <li>
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li><a href="{{ url('shoping') }}">Shop</a></li>
           
           <li><a href="{{ url('new-arrivals') }}">New Arrivals</a></li>
 <li><a href="{{ url('About-us') }}">About</a></li>
            <li  class="active"><a href="{{ url('contact') }}">Contact</a></li>
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
    
    <div class="site-blocks-cover inner-page" style="background-image: url('images/hero_2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center" data-aos="fade">
      <div class="container">
        <div class="row">
        
        </div>
      </div>
    </div>

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-3 text-black">Get In Touch</h2>
          </div>
          <div class="col-md-7">
            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
            <form action="{{ route('contact.store') }}" method="POST">

                @csrf
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_fname" name="c_fname">
                  </div>
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_lname" name="c_lname">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_subject" class="text-black">Subject </label>
                    <input type="text" class="form-control" id="c_subject" name="c_subject">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Message </label>
                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send Message">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-5 ml-auto">
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">New York</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">London</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
            <div class="p-4 border mb-3">
              <span class="d-block text-primary h6 text-uppercase">Canada</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>

          </div>
        </div>
      </div>
    </div>


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