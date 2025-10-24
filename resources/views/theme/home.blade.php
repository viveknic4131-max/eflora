@extends('theme.layouts.app')

@section('title', 'Home | E-Flora')
<style>
.scrollable-list {
    max-height: 300px; /* Adjust the height as needed */
    overflow-y: auto; /* Scroll vertically if content exceeds height */
    padding-right: 10px; /* Optional: space for scrollbar */
}
.scrollable-list ul li a {
    display: block;
}
</style>

@section('content')

    <!-- Hero Banner -->
    <section class="hero-banner d-flex align-items-center text-center text-light"
        style="background: url('{{ asset('images/ss.jpg') }}') center/cover no-repeat;">

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


{{-- <section class="py-5 bg-light">
    <div class="container text-center">
        <div class="row">
            <!-- BSI Volume Column -->
            <div class="col-md-6 col-sm-6">
                <h2 class="fw-bold mb-4 text-success" style="font-weight: 700">BSI Volume</h2>
                <div class="scrollable-list">
                    <ul class="list-unstyled">
                        @foreach ($bsiVolume as $volume)
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-success">
                                    {{ $volume['volume'] }} - {{ $volume['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Flora Of India Column -->
            <div class="col-md-6 col-sm-6">
                <h2 class="fw-bold mb-4 text-success" style="font-weight: 700">Flora Of India</h2>
                <div class="scrollable-list">
                    <ul class="list-unstyled">
                        @foreach ($floraofIndia as $flora)
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-success">
                                    {{ $flora['volume'] }} - {{ $flora['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<section class="py-5 ">
  <div class="container text-center">
    <div class="row g-4">
      <!-- BSI Volume Column -->
      <div class="col-md-6 col-sm-6">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h2 class="fw-bold mb-4 text-success" style="font-weight: 700">BSI Volume</h2>
            <div class="scrollable-list" style="max-height: 250px; overflow-y: auto;">
              <ul class="list-unstyled mb-0">
                @foreach ($bsiVolume as $volume)
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none text-success">
                      {{ $volume['volume'] }} - {{ $volume['name'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Flora Of India Column -->
      <div class="col-md-6 col-sm-6">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body">
            <h2 class="fw-bold mb-4 text-success" style="font-weight: 700">Flora Of India</h2>
            <div class="scrollable-list" style="max-height: 250px; overflow-y: auto;">
              <ul class="list-unstyled mb-0">
                @foreach ($floraofIndia as $flora)
                  <li class="mb-2">
                    <a href="#" class="text-decoration-none text-success">
                      {{ $flora['volume'] }} - {{ $flora['name'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
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
                        <img src="{{ asset('storage/plants/basil.jpg') }}" class="card-img-top" alt="Plant 2">
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

            <div class="logo-slider-1">
                {{-- <h2>Simple partners logo carousel slider</h2> --}}
                <div class="owl-carousel version-1">
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>
                    <div> <img src="{{ asset('images/sunflower.jpg') }}"> </div>

                </div>
            </div>
            <!-- End Simple logo carousel slider -->


        </div>
    </section>



@endsection
