@extends('theme.layouts.app')

@section('title', 'Home | E-Flora')

@section('content')

    <!-- Hero Banner -->
    <section class="hero-banner d-flex align-items-center text-center text-light"
        style="background: url('{{ asset('images/herobanner.jpg') }}') center/cover no-repeat;">

        <div class="container">
            <h1 class="display-4 fw-bold">Explore the World of Plants</h1>
            <p class="lead mb-5">Search thousands of species and discover the beauty of nature 🌿</p>

            <form action="{{ url('/search') }}" method="GET" class="row justify-content-center">
                @csrf
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control"
                            placeholder="Search for plants, species...">
                        <button type="submit" class="btn btn-success px-4">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container text-center ">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <h2 class="fw-bold mb-4 text-success" style="font-weight: 700">About E-Flora</h2>
                    <p class="lead text-success mb-5">
                        E-Flora is your digital gateway to discover, learn, and explore the beautiful world of plants.
                        Whether you're a student, researcher, or a nature enthusiast, we bring plant knowledge closer to
                        you.
                    </p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <img src="{{ asset('images/about.jpg') }}" class="img-fluid rounded shadow" alt="About Plants">
                </div>
            </div>


        </div>
    </section>

    <!-- Featured Plants Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-success" style="font-weight: 700">Featured Plants</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/rosaindica.jpg') }}" class="card-img-top" alt="Plant 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Rose</h5>
                            <p class="card-text text-muted">A symbol of love and beauty, roses have been admired for
                                centuries.</p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/basil.jpg')}}" class="card-img-top" alt="Plant 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Sunflower</h5>
                            <p class="card-text text-muted">Known for following the sun, sunflowers bring joy and
                                positivity.</p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/Madhuca.jpg') }}" class="card-img-top" alt="Plant 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tulip</h5>
                            <p class="card-text text-muted">Tulips bloom in a variety of colors, symbolizing perfect love.
                            </p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- Call to Action -->
    <section class="py-5 text-white text-center" style="background: #198754;">
        <div class="container">
            <h2 class="fw-bold mb-3">Join Our Community</h2>
            <p class="lead mb-4">Be part of E-Flora and contribute to spreading plant knowledge 🌱</p>
            <a href="{{ url('/register') }}" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-5 text-success" style="font-weight: 700">Plant Gallery</h2>
            {{-- <div class="row g-3">
                <div class="col-6 col-md-3">
                    <img src="{{ asset('images/gallery1.jpg') }}" class="img-fluid rounded shadow-sm" alt="Gallery">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('images/gallery2.jpg') }}" class="img-fluid rounded shadow-sm" alt="Gallery">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('images/gallery3.jpg') }}" class="img-fluid rounded shadow-sm" alt="Gallery">
                </div>
                <div class="col-6 col-md-3">
                    <img src="{{ asset('images/gallery4.jpg') }}" class="img-fluid rounded shadow-sm" alt="Gallery">
                </div>
            </div> --}}

            <!-- Simple logo carousel slider -->
  <div class="logo-slider-1">
    {{-- <h2>Simple partners logo carousel slider</h2> --}}
    <div class="owl-carousel version-1">
       <div> <img src="{{ asset('storage/plants/rosaindica.jpg') }}"> </div>
      <div> <img src="{{asset('storage/plants/basil.jpg') }}"> </div>
      <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
      <div> <img src="{{ asset('storage/plants/rosaindica.jpg') }}"> </div>
      <div> <img src="{{ asset('storage/plants/Madhuca.jpg') }}"> </div>
      <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
      <div> <img src="{{ asset('storage/plants/Madhuca.jpg') }}"> </div>
    </div>
  </div>
  <!-- End Simple logo carousel slider -->


        </div>
    </section>



@endsection
