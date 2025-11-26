@extends('theme.layouts.app')

@section('title', 'Home | E-Flora')

@section('content')
    <!-- ===== Hero Section ===== -->
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
                        {{-- @php
                        dd($errors->messages());
             @endphp --}}
                        <div class="text-white text-center small mt-2 fw-bold">
                            {{-- Please select a search type and enter text to search.
                             --}}

                            {{ $errors->first('q') }}
                            {{ $errors->first('plant_type') }}

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



{{-- ✅ jQuery for AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(function() {

        // ===== Initial Load =====
        loadBsiVolume("{{ route('bsi.volume') }}");
        loadFloraOfIndia("{{ route('flora.india') }}");

        function showLoader() {
            $('.loader-overlay').fadeIn(200);
        }

        function hideLoader() {
            $('.loader-overlay').fadeOut(200);
        }

        function loadBsiVolume(url) {
            showLoader();
            $.get(url, function(data) {
                $('#bsiVolumeContainer').html(data);
            }).always(hideLoader);
        }

        function loadFloraOfIndia(url) {
            showLoader();
            $.get(url, function(data) {
                $('#floraOfIndiaContainer').html(data);
            }).always(hideLoader);
        }

        // ===== Pagination =====
        $(document).on('click', '#bsiVolumeContainer .pagination a', function(e) {
            e.preventDefault();
            loadBsiVolume($(this).attr('href'));
        });

        $(document).on('click', '#floraOfIndiaContainer .pagination a', function(e) {
            e.preventDefault();
            loadFloraOfIndia($(this).attr('href'));
        });

        // ===== Search Suggestion Logic =====
        const input = $("#searchInput");
        const suggestionsBox = $("#suggestions");

        input.on("input", function() {
            const query = $(this).val().trim();
            const plantType = $('input[name="plant_type"]:checked').val() || '';

            if (query.length < 2) {
                suggestionsBox.addClass("d-none");
                return;
            }

            const url =
                `{{ route('search.suggest') }}?q=${encodeURIComponent(query)}&plant_type=${encodeURIComponent(plantType)}`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    suggestionsBox.empty();
                    let hasResults = false;

                    $.each(data, function(type, items) {
                        if (items.length > 0) {
                            hasResults = true;
                            // ✅ Colorful Bootstrap heading (no custom CSS)
                            suggestionsBox.append(`
                            <li class="list-group-item fw-bold text-uppercase bg-success text-white small py-2">
                                ${type}
                            </li>
                        `);
                            $.each(items, function(i, item) {
                                suggestionsBox.append(`
                                <li class="list-group-item list-group-item-action suggestion-item" data-name="${item.name}">
                                    ${item.name}
                                </li>
                            `);
                            });
                        }
                    });

                    if (hasResults) suggestionsBox.removeClass("d-none");
                    else suggestionsBox.addClass("d-none");
                })
                .catch(() => suggestionsBox.addClass("d-none"));
        });

        // ===== Click Suggestion → Redirect =====
        $(document).on("click", ".suggestion-item", function() {
            const keyword = $(this).data("name");
            const plantType = $('input[name="plant_type"]:checked').val() || '';
            const searchUrl =
                `{{ route('search') }}?q=${encodeURIComponent(keyword)}&plant_type=${encodeURIComponent(plantType)}`;
            window.location.href = searchUrl;
        });

        // ===== Enter Key → Redirect =====
        input.on("keypress", function(e) {
            if (e.which === 13) {
                e.preventDefault();
                const keyword = $(this).val().trim();
                const plantType = $('input[name="plant_type"]:checked').val() || '';
                if (keyword !== '') {
                    const searchUrl =
                        `{{ route('search') }}?q=${encodeURIComponent(keyword)}&plant_type=${encodeURIComponent(plantType)}`;
                    window.location.href = searchUrl;
                }
            }
        });

        // ===== Hide Suggestions on Outside Click =====
        $(document).on("click", function(e) {
            if (!$(e.target).closest("#suggestions, #searchInput").length) {
                suggestionsBox.addClass("d-none");
            }
        });
    });
</script>
