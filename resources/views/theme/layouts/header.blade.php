<!-- ===== Top Utility Bar ===== -->
<nav id="topbar" class="bg-white border-bottom py-1 w-100 topbar-visible">
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col-12 d-flex align-items-center justify-content-end flex-wrap text-end small">
        <a href="#" class="text-dark text-decoration-none me-2">Skip To Main Content &nbsp;&nbsp;&nbsp;&nbsp;|</a>
        <a href="#" class="text-dark text-decoration-none me-2">&nbsp;&nbsp;&nbsp;&nbsp;Screen Reader Access &nbsp;&nbsp;&nbsp;&nbsp;|</a>
        <a href="#" id="_smallify" class="text-dark text-decoration-none fw-bold me-1">&nbsp;&nbsp;&nbsp;&nbsp;A-&nbsp;&nbsp;&nbsp;&nbsp;|</a>
        <a href="#" id="_reset" class="text-dark text-decoration-none fw-bold me-1"> &nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;&nbsp;|</a>
        <a href="#" id="_biggify" class="text-dark text-decoration-none fw-bold me-2">&nbsp;&nbsp;&nbsp;&nbsp;A+&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <a href="#" class="text-dark text-decoration-none me-2"><i class="fa fa-sitemap" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</a>
        {{-- <select class="form-select form-select-sm border-0 bg-white text-dark ms-2" style="width: auto;">
          <option selected>English</option>
          <option>हिंदी</option>
        </select> --}}
      </div>
    </div>
  </div>
</nav>

<!-- ======= Main Navbar ======= -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase text-success" href="{{ url('/') }}">
      <i class="fa fa-leaf me-2"></i>E-Flora
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav me-3">
        <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Create CheckList</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Cite</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- ======= Styles ======= -->
<style>

</style>

<!-- ======= jQuery Scroll Script ======= -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      // Hide topbar, pull navbar up
      $('#topbar').addClass('topbar-hidden').removeClass('topbar-visible');
      $('.sticky-top').addClass('sticky-nav');
    } else {
      // Show topbar again
      $('#topbar').removeClass('topbar-hidden').addClass('topbar-visible');
      $('.sticky-top').removeClass('sticky-nav');
    }
  });
</script>
