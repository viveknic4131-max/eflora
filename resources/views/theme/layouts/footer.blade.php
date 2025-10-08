<footer class="bg-dark text-light pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row">

      <!-- Company Info -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase fw-bold text-success mb-3">
          <i class="fa fa-leaf me-2"></i>E-Flora
        </h5>
        <p>
          Your trusted cleaning & lifestyle partner.
          We make spaces shine with eco-friendly solutions 🌿
        </p>
        <!-- Social Icons -->
        <div>
          <a href="#" class="text-light me-3"><i class="fa fa-facebook"></i></a>
          <a href="#" class="text-light me-3"><i class="fa fa-twitter"></i></a>
          <a href="#" class="text-light me-3"><i class="fa fa-instagram"></i></a>
          <a href="#" class="text-light"><i class="fa fa-linkedin"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase fw-bold text-success mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}" class="text-light text-decoration-none d-block mb-2">Home</a></li>
          <li><a href="{{ url('/about') }}" class="text-light text-decoration-none d-block mb-2">About</a></li>
          <li><a href="{{ url('/services') }}" class="text-light text-decoration-none d-block mb-2">Services</a></li>
          <li><a href="{{ url('/contact') }}" class="text-light text-decoration-none d-block">Contact</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase fw-bold text-success mb-3">Contact Us</h5>
        <p><i class="fa fa-map-marker me-2"></i>123 Green Street, City, Country</p>
        <p><i class="fa fa-phone me-2"></i>+1 234 567 890</p>
        <p><i class="fa fa-envelope me-2"></i>info@eflora.com</p>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center border-top pt-3 mt-3">
      <small>© {{ date('Y') }} <span class="text-success">E-Flora</span>. All Rights Reserved.</small>
    </div>
  </div>
</footer>
