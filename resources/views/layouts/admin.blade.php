<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Sidebar Design</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    /* Custom styles for the sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 250px;
      background-color: #343a40;
      color: #fff;
      padding-top: 3.5rem; /* Adjust according to navbar height */
      transition: transform 0.3s ease-in-out;
      z-index: 1000; /* Ensure the sidebar is above other content */
    }
    .navbar-nav{
        position: relative;
    }

    .sidebar.closed {
      transform: translateX(-250px);
    }

    /* Custom styles for sidebar links */
    .sidebar .nav-link {
      color: #fff;
    }

    .sidebar .nav-link:hover {
      background-color: #495057;
    }

    /* Custom styles for active sidebar link */
    .sidebar .nav-link.active {
      background-color: #007bff;
      color: #fff;
    }

    /* Style for content area */
    .content-area {
      margin-left: 250px; /* Adjust according to sidebar width */
      transition: margin-left 0.3s ease-in-out;
      padding: 20px; /* Add padding to the content area */
      background-color: #f8f9fa; /* Light background color */
      color: #333; /* Text color */
    }

    /* Style for navbar */
    .navbar {
      background-color: #343a40;
      height: 60px;
    }

    /* Style for navbar icon */
    .navbar-toggler-icon {
      color: #fff;
    }



  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" id="sidebarToggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="jj  navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a style="color: white;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="color: white;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="{{ route('user.index') }}"><i class="fas fa-home"></i> Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('Employeeindex') }}"> Employee</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('Clientindex') }}"> Client</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('Projectindex') }}"> Project</a>
    </li>
  </ul>
</div>

<!-- Page Content -->
       <main class="py-4">
            <div class="container mt-4">
                @yield('content')
            </div>
        </main>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Script to toggle the sidebar
  document.getElementById('sidebarToggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('closed');
    document.querySelector('.content-area').classList.toggle('closed');
  });
</script>

</body>
</html>
