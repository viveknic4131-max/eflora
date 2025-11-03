@extends('theme.layouts.app')

@section('title', 'Home | E-Flora')

@section('content')

    <!-- ===== Hero Section (Florize Style) ===== -->
    {{-- <section class="hero-florize">
        <div class="hero-overlay"></div>
        <div class="container text-center hero-content">
            <h1 class="hero-title">Experience the Elegance of Fresh Flowers</h1>
            <h4 class="hero-subtitle">
                The perfect gifts for your loved ones. Fresh flower delivery, every day, around the clock.
            </h4>
            <div class="hero-buttons d-flex justify-content-center gap-3 flex-wrap mt-4">
                <form action="{{ route('search') }}" method="POST"
                    class="row justify-content-center position-relative mt-4 hero-search-form">
                    @csrf
                    <div class="col-12 col-md-6">
                        <div class="input-group position-relative">
                            <input type="text" id="searchInput" name="q"
                                class="form-control form-control-lg rounded-pill shadow-sm text-center"
                                placeholder="Search for plants, species..." autocomplete="off" value="{{ request('q') }}"
                                style="z-index: 2;">

                            <!-- Suggestion Box -->
                            <ul id="suggestions"
                                class="list-group position-absolute start-0 w-100 d-none mt-2 shadow rounded-3"
                                style="z-index: 1000; max-height: 300px; overflow-y: auto; top: 100%;">
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section> --}}

    <section class="hero-section text-center d-flex align-items-center justify-content-center flex-column">
        <div class="container hero-content">
            <h1 class="hero-title">Experience the Living Wonders of Indian Flora</h1>
            <h4 class="hero-subtitle mt-3">
                Explore authentic botanical information, research, and plant.
            </h4>

            <!-- 🌸 Search Form -->
            <form action="{{ route('search') }}" method="POST"
                class="row justify-content-center position-relative mt-4 hero-search-form">
                @csrf
                <div class="col-12 col-md-6">
                    <div class="input-group position-relative  mb-3 justify-content-center">

                        <input type="radio"  name="plant_type" value="non-flowering">&nbsp;&nbsp; Flora of India&nbsp;&nbsp;
                        <input type="radio"  name="plant_type" value="flowering" checked>&nbsp;&nbsp; Plant Checklist of India &nbsp;&nbsp;

                    </div>
                    <div class="input-group position-relative">
                        <input type="text" id="searchInput" name="q"
                            class="form-control form-control-lg rounded-pill shadow-sm text-center"
                            placeholder="Search for plants, species..." autocomplete="off" value="{{ request('q') }}"
                            style="z-index: 2;">

                        <!-- Suggestion Box -->
                        <ul id="suggestions" class="list-group position-absolute start-0 w-100 d-none mt-2 shadow rounded-3"
                            style="z-index: 1000; max-height: 300px; overflow-y: auto; top: 100%;">
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Auto-submit on Enter -->





    <!-- ===== BSI Volume / Flora of India ===== -->
    {{-- <section class="py-5">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h2 class="fw-bold mb-4 text-success">BSI Volume</h2>
                            <div style="max-height:250px;overflow-y:auto;">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($bsiVolume as $volume)
                                        <li class="mb-2">
                                            <a href="{{ route('get.family', ['volume' => $volume['volume_code']]) }}"
                                                class="text-decoration-none text-success">
                                                {{ $volume['volume'] }} - {{ $volume['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h2 class="fw-bold mb-4 text-success">Flora Of India</h2>
                            <div style="max-height:250px;overflow-y:auto;">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($floraofIndia as $flora)
                                        <li class="mb-2">
                                            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}"
                                                class="text-decoration-none text-success">
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
    </section> --}}

    {{-- <section class="py-5 modern-section">
        <div class="container text-center">
            <div class="row g-4">
                <!-- BSI Volume -->
                <div class="col-md-6">
                    <div class="modern-card h-100">
                        <div class="card-body">
                            <h2 class="fw-bold mb-4 section-title">BSI Volume</h2>
                            <div class="scroll-box">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($bsiVolume as $volume)
                                        <li class="mb-2">
                                            <a href="{{ route('get.family', ['volume' => $volume['volume_code']]) }}"
                                                class="volume-link">
                                                {{ $volume['volume'] }} - {{ $volume['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flora Of India -->
                <div class="col-md-6">
                    <div class="modern-card h-100">
                        <div class="card-body">
                            <h2 class="fw-bold mb-4 section-title">Flora of India</h2>
                            <div class="scroll-box">
                                <ul class="list-unstyled mb-0">
                                    @foreach ($floraofIndia as $flora)
                                        <li class="mb-2">
                                            <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}"
                                                class="volume-link">
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
    </section> --}}

    <section class="py-5 modern-section">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-6 fw-bold section-heading">Explore Botanical Volumes</h1>
                <p class="text-muted">Browse through detailed records of <span class="text-accent">BSI Volumes</span> and
                    <span class="text-accent">Flora of India</span>.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- BSI Volume -->
                <div class="col-md-6 col-lg-5">
                    <div class="modern-card glass-card">
                        <div class="card-body p-4">
                            <h2 class="fw-bold mb-4 section-title">BSI Volume</h2>

                            <ul class="list-unstyled mb-4">
                                @foreach ($bsiVolume as $volume)
                                    <li class="mb-3">
                                        <a href="{{ route('get.family', ['volume' => $volume['volume_code']]) }}"
                                            class="volume-link">
                                            <i class="fa-solid fa-leaf me-2 text-accent"></i>
                                            {{ $volume['volume'] }} - {{ $volume['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $bsiVolume->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flora Of India -->
                <div class="col-md-6 col-lg-5">
                    <div class="modern-card glass-card">
                        <div class="card-body p-4">
                            <h2 class="fw-bold mb-4 section-title">Flora of India</h2>

                            <ul class="list-unstyled mb-4">
                                @foreach ($floraofIndia as $flora)
                                    <li class="mb-3">
                                        <a href="{{ route('get.family', ['volume' => $flora['volume_code']]) }}"
                                            class="volume-link">
                                            <i class="fa-solid fa-seedling me-2 text-accent"></i>
                                            {{ $flora['volume'] }} - {{ $flora['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $floraofIndia->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ===== About Section ===== -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4 text-success">About E-Flora</h2>
                    <p class="lead text-muted">
                        E-Flora is your digital gateway to discover, learn, and explore the beautiful world of plants.
                        Whether you're a student, researcher, or nature enthusiast — we bring plant knowledge closer to you.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('images/about.jpg') }}" class="img-fluid rounded shadow" alt="About Plants">
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Featured Plants ===== -->
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-success">Featured Plants</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/rosaindica.jpg') }}" class="card-img-top" alt="Rose">
                        <div class="card-body text-center">
                            <h5 class="card-title">Rose</h5>
                            <p class="text-muted">A symbol of love and beauty, roses have been admired for centuries.</p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/basil.jpg') }}" class="card-img-top" alt="Sunflower">
                        <div class="card-body text-center">
                            <h5 class="card-title">Sunflower</h5>
                            <p class="text-muted">Known for following the sun, sunflowers bring joy and positivity.</p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="{{ asset('storage/plants/Madhuca.jpg') }}" class="card-img-top" alt="Tulip">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tulip</h5>
                            <p class="text-muted">Tulips bloom in a variety of colors, symbolizing perfect love.</p>
                            <a href="#" class="btn btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA Section ===== -->
    <section class="py-5 text-white text-center cta-florize">
        <div class="container">
            <h2 class="fw-bold mb-3">Join Our Community</h2>
            <p class="lead mb-4">Be part of E-Flora and contribute to spreading plant knowledge 🌱</p>
            <a href="{{ url('/register') }}" class="btn btn-light btn-lg rounded-pill">Get Started</a>
        </div>
    </section>

@endsection
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const input = document.getElementById("searchInput");
        const suggestionsBox = document.getElementById("suggestions");

        input.addEventListener("input", function() {
            const query = this.value.trim();
            if (query.length < 2) {
                suggestionsBox.classList.add("d-none");
                return;
            }

            fetch(`{{ route('search.suggest') }}?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';

                    let hasResults = false;

                    Object.keys(data).forEach(type => {
                        if (data[type].length > 0) {
                            hasResults = true;

                            // Group header
                            const header = document.createElement("li");
                            header.className =
                                "list-group-item flora-active fw-bold text-uppercase";
                            header.textContent = type;
                            suggestionsBox.appendChild(header);


                            data[type].forEach(item => {
                                const li = document.createElement("li");
                                li.className =
                                    "list-group-item list-group-item-action";
                                li.textContent = item.name;
                                li.style.cursor = "pointer";
                                li.onclick = () => {
                                    input.value = item
                                        .name;
                                    suggestionsBox.classList.add(
                                        "d-none");
                                };
                                suggestionsBox.appendChild(li);
                            });
                        }
                    });

                    if (hasResults) {
                        suggestionsBox.classList.remove("d-none");
                    } else {
                        suggestionsBox.classList.add("d-none");
                    }
                })
                .catch(() => suggestionsBox.classList.add("d-none"));
        });

        // Hide suggestion box when clicked outside
        document.addEventListener("click", (e) => {
            if (!suggestionsBox.contains(e.target) && e.target !== input) {
                suggestionsBox.classList.add("d-none");
            }
        });
    });


    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.form.submit();
        }
    });
</script>

