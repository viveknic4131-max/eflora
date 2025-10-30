@extends('theme.layouts.app')

@section('title', 'Home | E-Flora')
<style>
    .scrollable-list {
        max-height: 300px;
        /* Adjust the height as needed */
        overflow-y: auto;
        /* Scroll vertically if content exceeds height */
        padding-right: 10px;
        /* Optional: space for scrollbar */
    }

    .scrollable-list ul li a {
        display: block;
    }

    .list-group-item.active {
        background-color: #198754 !important;
        border-color: #198754 !important;
        font-weight: bold;
    }

    #suggestions .list-group-item {
        cursor: pointer;
    }

    #suggestions .list-group-item:hover {
        background-color: #198754;
        color: white;
    }
</style>

@section('content')

    <!-- Hero Banner -->
    <section class="hero-banner d-flex align-items-center text-center text-light"
        style="background: url('{{ asset('images/ss.jpg') }}') center/cover no-repeat;">

        <div class="container">
            <h1 class="display-4 fw-bold">Explore the World of Plants</h1>
            <p class="lead mb-5">Search thousands of species and discover the beauty of nature 🌿</p>

            {{-- <form action="{{ route('search') }}" method="POST" class="row justify-content-center">
                @csrf
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <input type="text" id="searchInput" name="q" class="form-control"
                            placeholder="Search for plants, species..." autocomplete="off" value="{{ request('q') }}">
                        <ul id="suggestions" class="list-group position-absolute w-100 d-none"
                            style="z-index: 1000; max-height: 300px; overflow-y: auto;"></ul>
                    </div>
                    <button type="submit" class="btn btn-success px-4">Search</button>
                </div>

            </form> --}}
            <form action="{{ route('search') }}" method="POST" class="row justify-content-center position-relative">
                @csrf
                <div class="col-12 col-md-6 ">
                    <div class="input-group">
                        <input type="text" id="searchInput" name="q"
                            class="form-control form-control-lg rounded-pill shadow-sm text-center"
                            placeholder="Search for plants, species..." autocomplete="off" value="{{ request('q') }}"
                            style="z-index: 2;">

                        <!-- Suggestion Box -->
                        <ul id="suggestions" class="list-group position-absolute start-0 w-100 d-none mt-2 shadow rounded-3"
                            style="z-index: 1000; max-height: 300px; overflow-y: auto; top: 100%;">
                        </ul>
                    </div>

                        <button type="submit" class="btn btn-success px-4 rounded-pill">Search</button>

                </div>
            </form>

        </div>
    </section>



{{--
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
    </section> --}}

    <section class="py-5">
    <div class="container text-center">
        <div class="row g-4">
            <!-- 🌿 BSI Volume Column -->
            <div class="col-md-6 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h2 class="fw-bold mb-4 text-success">BSI Volume</h2>
                        <div class="scrollable-list" style="max-height: 250px; overflow-y: auto;">
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

            <!-- 🌸 Flora of India Column -->
            <div class="col-md-6 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h2 class="fw-bold mb-4 text-success">Flora Of India</h2>
                        <div class="scrollable-list" style="max-height: 250px; overflow-y: auto;">
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

{{-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[name="q"]');
    const suggestionBox = document.createElement('div');

    suggestionBox.classList.add('list-group', 'position-absolute', 'w-50', 'mx-auto');
    suggestionBox.style.zIndex = '1000';
    suggestionBox.style.maxHeight = '300px';
    suggestionBox.style.overflowY = 'auto';
    searchInput.parentNode.appendChild(suggestionBox);

    let typingTimer;
    const delay = 300;

    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchSuggestions, delay);
    });

    function fetchSuggestions() {
        const query = searchInput.value.trim();
        suggestionBox.innerHTML = '';

        if (query.length < 2) return; // skip short queries

        fetch(`/search-suggest?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                Object.keys(data).forEach(type => {
                    if (data[type].length > 0) {
                        const header = document.createElement('div');
                        header.classList.add('list-group-item', 'active');
                        header.textContent = type;
                        suggestionBox.appendChild(header);

                        data[type].forEach(item => {
                            const link = document.createElement('a');
                            link.classList.add('list-group-item', 'list-group-item-action');
                            link.textContent = item.name;
                            link.href = `${item.name}`;
                            suggestionBox.appendChild(link);
                        });
                    }
                });
            })
            .catch(err => console.error(err));
    }

    // Hide suggestions when clicked outside
    document.addEventListener('click', (e) => {
        if (!suggestionBox.contains(e.target) && e.target !== searchInput) {
            suggestionBox.innerHTML = '';
        }
    });
});
</script> --}}


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
                                "list-group-item active fw-bold text-uppercase";
                            header.textContent = type;
                            suggestionsBox.appendChild(header);

                            // Items
                            data[type].forEach(item => {
                                const li = document.createElement("li");
                                li.className =
                                    "list-group-item list-group-item-action";
                                li.textContent = item.name;
                                li.style.cursor = "pointer";
                                li.onclick = () => {
                                    input.value = item
                                        .name; // ✅ Fill input with clicked suggestion
                                    suggestionsBox.classList.add(
                                        "d-none"); // Hide box
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
</script>
