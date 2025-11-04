<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Florize Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="loader-overlay" style="display:none;">
  <div class="loader"></div>
</div>

  <!-- ===== Florize Navbar ===== -->
  <nav class="navbar navbar-expand-lg navbar-florize fixed-top py-3">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        eFlora<span style="color:#198754;">.</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-center" id="mainNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a href="{{ url('/') }}" class="nav-link active">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Create Checklist</a></li>
          <li class="nav-item"><a href="#" class="nav-link">About Us</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Cite</a></li>
          <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
        </ul>
      </div>

      <div class="social-icons d-none d-lg-block">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-x-twitter"></i></a>
        <a href="#"><i class="fab fa-pinterest-p"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </nav>

  <!-- Yield page content -->
  <main>
    @yield('content')
  </main>

  <footer>
    <p class="mb-0">© {{ date('Y') }} E-Flora. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
