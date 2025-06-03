<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
 :root {
  --sidebar-gradient: linear-gradient(135deg, #EE4266, #ff758f); /* VIP Gradient */
  --text-color: #ffffff;       /* White for text */
  --hover-bg: rgba(255, 255, 255, 0.1); /* Subtle hover */
  --content-bg: #f9f9f9;       /* Light background */
  --accent-color: #EE4266;
}

    

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--content-bg);
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .sidebar {
  width: 250px;
  background: var(--sidebar-gradient);
  color: var(--text-color);
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding-top: 60px;
  z-index: 1050;
  transition: left 0.3s ease;
  box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
}

.sidebar h4 {
  text-align: center;
  margin-top: -36px;
  color: #ffffff;
  padding-bottom: 10px;
  font-weight: bold;
  letter-spacing: 1px;
}

.sidebar .nav-link {
  color: var(--text-color);
  padding: 12px 20px;
  transition: background 0.3s, border-left 0.3s;
  border-left: 4px solid transparent;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
  background-color: var(--hover-bg);
  border-left: 4px solid #ffffff;
  color: #ffffff;
}
.sidebar .nav-link:hover {
  box-shadow: inset 5px 0 0 #ffffff;
}


    .content-area {
      margin-left: 250px;
      padding: 20px;
      background-color: var(--content-bg);
      flex: 1;
    }

    .footer {
      background-color: #fff;
      padding: 10px 0;
      text-align: center;
      border-top: 1px solid #dee2e6;
    }

    .navbar {
      border-bottom: 1px solid #e0e0e0;
    }

    @media (max-width: 768px) {
      .sidebar {
        left: -250px;
      }

      .sidebar.active {
        left: 0;
      }

      .content-area {
        margin-left: 0;
      }

      .sidebar-backdrop {
        display: none;
      }

      .sidebar-backdrop.active {
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1040;
      }
    }

    .dropdown-menu {
      font-size: 0.95rem;
    }

    .dropdown-item i {
      color: var(--accent-color);
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h4>Admin Panel</h4>
    <ul class="nav flex-column mt-4">
    <li class="nav-item">
  <a class="nav-link" href="{{ route('home') }}">
    <i class="bi bi-house-door me-2"></i>Home
  </a>
</li>

      <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="bi bi-grid me-2"></i>Categories</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam me-2"></i>Products</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.tags.index') }}"><i class="bi bi-tags me-2"></i>Tags</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.list') }}"><i class="bi bi-basket me-2"></i>Orders</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.coupons.index') }}"><i class="bi bi-ticket-detailed me-2"></i>Coupons</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i>Users</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.contacts') }}"><i class="bi bi-envelope me-2"></i>Messages</a></li>
    </ul>
  </div>

  <!-- Sidebar Backdrop -->
  <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar()"></div>

  <!-- Wrapper -->
  <div class="wrapper">
    <!-- Content Area -->
    <div class="content-area">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
          <button class="btn d-md-none" type="button" onclick="toggleSidebar()">
            <i class="bi bi-list fs-3"></i>
          </button>

          <div class="ms-auto d-flex align-items-center">
            @auth
            <div class="dropdown">
              <button class="btn dropdown-toggle d-flex align-items-center border-0 bg-transparent" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle" style="width: 35px; height: 35px;" alt="Avatar">
                <span class="ms-2 fw-semibold text-dark">{{ Auth::user()->name }}</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm" aria-labelledby="userDropdown">
                <li>
  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
    <i class="bi bi-person me-2"></i> Profile
  </a>
</li>

              <li>
  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#themeSettingsModal">
      <i class="bi bi-gear me-2"></i>Settings
  </a>
</li>

                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                  </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
              </ul>
            </div>
            @endauth
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <div class="container mt-5 pt-4">
        @yield('content')
      </div>
    </div>

    <!-- Footer -->
<div class="footer">
  <p class="mb-0 text-muted">
    &copy; 2025 Admin Panel. All rights reserved. | Made by <strong>Dua Memon</strong>
  </p>
</div>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profile Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Profile Update Form -->
        <form method="POST" action="{{ route('profile.update') }}">
          @csrf
          @method('PUT') <!-- PUT request for updating data -->
          
          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
          </div>

          <!-- Email (Read-only) -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
          </div>

          <!-- Address -->
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Theme & Account Settings Modal -->
<div class="modal fade" id="themeSettingsModal" tabindex="-1" aria-labelledby="themeSettingsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="themeSettingsModalLabel">Settings</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        {{-- Dark/Light Mode Toggle --}}
        <div class="form-check form-switch mb-4">
          <input class="form-check-input" type="checkbox" id="darkModeToggle" onchange="toggleTheme()">
          <label class="form-check-label" for="darkModeToggle">Enable Dark Mode</label>
        </div>

        {{-- Delete Account --}}
        <div class="border-top pt-3">
          <h6 class="text-danger mb-2">Danger Zone</h6>
          <form action="{{ route('user.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
              <i class="bi bi-trash me-2"></i>Delete My Account
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Bootstrap JS (for modal) -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('active');
      document.getElementById('sidebarBackdrop').classList.toggle('active');
    }

  function toggleTheme() {
    const isDark = document.body.classList.toggle('bg-dark');
    document.body.classList.toggle('text-white');

    // Save preference to localStorage (optional)
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }

  // Load theme preference on page load
  window.onload = function () {
    if (localStorage.getItem('theme') === 'dark') {
      document.getElementById('darkModeToggle').checked = true;
      toggleTheme();
    }
  };


  </script>
</body>
</html>
