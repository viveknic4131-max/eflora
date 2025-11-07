<footer class="flora-footer">
    <div class="footer-top">
        <div class="container py-5">
            <div class="row align-items-center text-center text-md-start">
                <!-- Social & Logo -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-3 flora-primary">Follow Our Social Network</h6>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Logo -->


                <!-- Newsletter -->
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <h2 class="footer-logo mb-0">
                        <img src="{{ asset('images/bsi_logo.png') }}" alt="BSI Logo" style="height:60px;">
                    </h2>
                </div>
                <div class="col-md-4 mb-4 mb-md-0 text-center">
                    <h2 class="footer-logo mb-0">
                        e<span class="flora-primary">Flora</span>.
                    </h2>
                </div>

            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="footer-bottom py-5">
        <div class="container">
            <div class="row ">
                <!-- Contact -->
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Get in Touch</h6>
                    <p><i class="fas fa-phone me-2 text-success"></i> <strong>Customer Support:</strong> +91 98765 43210
                    </p>
                    <p><i class="fas fa-envelope me-2 text-success"></i> support@eflora.in</p>
                </div>

                <!-- Company -->
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Leadership</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Publications</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Services</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="#">Plant Identification</a></li>
                        <li><a href="#">Herbarium Access</a></li>
                        <li><a href="#">Data Contribution</a></li>
                        <li><a href="#">Research Collaboration</a></li>
                    </ul>
                </div>

                <!-- Gallery -->
                {{-- <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Our Gallery</h6>
                    <div class="d-flex gap-2">
                        <img src="/images/plant1.jpg" class="footer-gallery-img" alt="">
                        <img src="/images/plant2.jpg" class="footer-gallery-img" alt="">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright py-3 text-center">
        <small>Copyright © {{ date('Y') }} <strong>eFlora</strong>. All rights reserved. | <a href="#">Privacy
                Policy</a> | <a href="#">Terms</a></small>
    </div>
</footer>
