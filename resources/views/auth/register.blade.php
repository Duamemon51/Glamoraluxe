<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GLAMORA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

        <!-- Font Awesome CDN -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <!-- Bootstrap 5 Bundle JS (including Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  </head>
   
    <style>
        .icons-btn {
    display: inline-block; /* Ensure the button is visible */
}

.icon-login {
    font-size: 24px; /* Adjust size of the icon */
    color: #333; /* Color of the icon */
}

        body {
            background: linear-gradient(to right, #fdfbfb, #ebedee);
            font-family: 'Poppins', sans-serif;
        }

        .register-card {
            max-width: 400px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        .register-card:hover {
            transform: scale(1.02);
            box-shadow: 0 16px 50px rgba(0, 0, 0, 0.2);
        }

        .register-header {
            background: linear-gradient(90deg, #ee4266, #f75f7a);
            padding: 20px;
            text-align: center;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .register-header h4 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            font-size: 14px;
            padding: 10px 12px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ee4266;
            box-shadow: 0 0 0 0.2rem rgba(238, 66, 102, 0.2);
        }

        .form-icon {
            margin-right: 6px;
            color: #ee4266;
        }

        .btn-shopmax {
            background-color: #ee4266;
            color: #fff;
            font-weight: 500;
            padding: 12px;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-shopmax:hover {
            background-color: #d63356;
            transform: scale(1.05);
        }

        .d-grid {
            margin-top: 20px;
        }

        .card-body {
            padding: 0;
        }

        .register-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .register-footer a {
            color: #ee4266;
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .register-card {
                margin: 10px;
            }
        }
        .login-icon {
    display: block !important;
    opacity: 1 !important;
    visibility: visible !important;
}

    </style>
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
        <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>

        <!-- Heart Icon (Wishlist) -->
      
        <!-- Shopping Bag Icon -->
      
           
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
 body.offcanvas-menu {
  overflow: hidden;
  height: 100vh;
  position: fixed;
  width: 100%;
}.site-wrap {
  height: 100%;
  position: relative;
}


</style>
          

<div class="container py-5">
    <div class="register-card">
        <div class="register-header">
            <h4><i class="fa fa-user-plus me-2"></i> Register</h4>
        </div>
        <div class="card-body">
          <!-- Display Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display Success Message -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-user form-icon"></i>Full Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-envelope form-icon"></i>Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-lock form-icon"></i>Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-lock form-icon"></i>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-phone form-icon"></i>Phone</label>
                    <input type="text" class="form-control" name="phone">
                </div>

                <div class="d-grid">
                    <button type="submit" id="registerBtn" class="btn btn-shopmax">
                        <i class="fa fa-check me-1"></i> Register
                    </button>
                </div>
            </form>
        </div>

        <div class="register-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</div>
<!-- Add this in your <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<footer class="site-footer custom-border-top">
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
<style>.site-footer {
    background-color: #ffffff; /* Set the background color to white */
    color: #333333; /* Ensure the text color is visible on a white background */
}

.site-footer a {
    color: #333333; /* Ensure link text is visible */
}

.site-footer a:hover {
    color: #ee4266; /* Change link color on hover */
}

.site-footer .footer-heading {
    color: #333333; /* Ensure headings are visible */
}

.site-footer .form-control {
    background-color: #f9f9f9; /* Lighter background for the input fields */
    border: 1px solid #ddd; /* Light border for the input fields */
}

.site-footer .btn-primary {
    background-color: #ee4266; /* Primary button color */
    border-color: #ee4266; /* Border color to match button */
        margin-top: -8px;
}

.site-footer .btn-primary:hover {
    background-color: #d63356; /* Button hover color */
    border-color: #d63356; /* Button hover border color */
}
</style>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>

<script src="js/main.js"></script>
<script>
    const registerForm = document.querySelector('form');
    const registerBtn = document.getElementById('registerBtn');

    registerForm.addEventListener('submit', function () {
        registerBtn.disabled = true;
        registerBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Processing...`;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
