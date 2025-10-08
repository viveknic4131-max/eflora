<style>
    .active {
        /* font-weight: bold; */
        color: #28a745 !important; /* Bootstrap's success color */
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
  <div class="container">

    <!-- Brand / Logo -->
    <a class="navbar-brand fw-bold text-uppercase text-success" href="{{ url('/') }}">
      <i class="fa fa-leaf me-2"></i>E-Flora
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu + Search (Right Side) -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav me-3">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Contact</a>
        </li>




        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            About
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ url('/') }}">About eFlora</a></li>
            <li><a class="dropdown-item" href="{{ url('/') }}">About WCVP</a></li>
            <li><a class="dropdown-item" href="{{ url('/') }}">What we do</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('/') }}">Compilers and Reviewers</a></li>
          </ul>
        </li>
        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            More
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ url('/blog') }}">Blog</a></li>
            <li><a class="dropdown-item" href="{{ url('/pricing') }}">Pricing</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('/contact') }}">Contact</a></li>
          </ul>
        </li> --}}
      </ul>

      <!-- Search -->
      {{-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form> --}}
    </div>

  </div>
</nav>
