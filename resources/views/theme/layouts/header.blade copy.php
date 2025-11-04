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
