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


            <form action="{{ route('search') }}" method="GET"
                class="row justify-content-center position-relative mt-4 hero-search-form">

                <div class="col-12 col-md-6 mt-3">

                    <div class="input-group position-relative mb-3 justify-content-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="floraOfIndia" name="plant_type"
                                value="flora_india">
                            <label class="form-check-label flora-label" for="floraOfIndia">Flora of India</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="plantChecklist" name="plant_type"
                                value="checklist" checked>
                            <label class="form-check-label flora-label" for="plantChecklist">Plant Checklist of
                                India</label>
                        </div>
                    </div>


                    <div class="input-group position-relative">
                        <input type="text" id="searchInput" name="q"
                            class="form-control form-control-lg rounded-pill shadow-sm text-center"
                            placeholder="Search for plants, species..." autocomplete="off" value="{{ request('q') }}"
                            style="z-index: 2;">


                        <ul id="suggestions" class="list-group position-absolute start-0 w-100 d-none mt-2 shadow rounded-3"
                            style="z-index: 1000; max-height: 300px; overflow-y: auto; top: 100%;">
                        </ul>
                    </div>
                    @if ($errors->has('plant_type') || $errors->has('q'))
                        <div class="text-danger text-center small mt-2 fw-bold">
                            Please select a search type and enter text to search.
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </section>



    <section class="py-5 modern-section">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-6 fw-bold section-heading flora-primary">Explore Botanical Volumes</h1>
                <p class="text-muted">
                    Browse detailed records of <span class="text-accent">BSI Volumes</span> and
                    <span class="text-accent">Flora of India</span>.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- BSI Volume -->
                <div class="col-md-6 ">
                    <div class="modern-card glass-card">
                        <div class="card-body p-4" id="bsiVolumeContainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>

                <!-- Flora of India -->
                <div class="col-md-6 ">
                    <div class="modern-card glass-card">
                        <div class="card-body p-4" id="floraOfIndiaContainer">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=====About Section=====-->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4 flora-primary">About E-Flora</h2>
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
    {{-- <section class="py-5 text-white text-center cta-florize">
        <div class="container">
            <h2 class="fw-bold mb-3">Join Our Community</h2>
            <p class="lead mb-4">Be part of E-Flora and contribute to spreading plant knowledge 🌱</p>
            <a href="{{ url('/register') }}" class="btn btn-light btn-lg rounded-pill">Get Started</a>
        </div>
    </section> --}}

@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.hero-search-form');

        form.addEventListener('submit', function(e) {
            const selected = document.querySelector('input[name="plant_type"]:checked');
            if (!selected) {
                e.preventDefault();
                alert('Please select a plant type (Flora of India or Checklist of India)');
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById("searchInput");
        const suggestionsBox = document.getElementById("suggestions");

        input.addEventListener("input", function() {
            const query = this.value.trim();

            // Get selected radio button
            const plantType = document.querySelector('input[name="plant_type"]:checked')?.value || '';

            if (query.length < 2) {
                suggestionsBox.classList.add("d-none");
                return;
            }

            // Add radio param to query
            const url =
                `{{ route('search.suggest') }}?q=${encodeURIComponent(query)}&plant_type=${encodeURIComponent(plantType)}`;

            fetch(url)
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
                                    input.value = item.name;
                                    suggestionsBox.classList.add("d-none");
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

        // Submit on Enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    });
</script>

{{-- ✅ jQuery for AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(function() {

        // Initial load
        loadBsiVolume("{{ route('bsi.volume') }}");
        loadFloraOfIndia("{{ route('flora.india') }}");

        // Show loader
        function showLoader() {
            $('.loader-overlay').fadeIn(200);
        }

        // Hide loader
        function hideLoader() {
            $('.loader-overlay').fadeOut(200);
        }

        // Load BSI Volume
        function loadBsiVolume(url) {
            showLoader();
            $.get(url, function(data) {
                $('#bsiVolumeContainer').html(data);
            }).always(function() {
                hideLoader();
            });
        }

        // Load Flora of India
        function loadFloraOfIndia(url) {
            showLoader();
            $.get(url, function(data) {
                $('#floraOfIndiaContainer').html(data);
            }).always(function() {
                hideLoader();
            });
        }

        // Pagination for BSI
        $(document).on('click', '#bsiVolumeContainer .pagination a', function(e) {
            e.preventDefault();
            loadBsiVolume($(this).attr('href'));
        });

        // Pagination for Flora
        $(document).on('click', '#floraOfIndiaContainer .pagination a', function(e) {
            e.preventDefault();
            loadFloraOfIndia($(this).attr('href'));
        });
    });
</script>
