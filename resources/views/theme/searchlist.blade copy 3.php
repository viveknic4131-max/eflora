@extends('theme.layouts.app')

@section('title', 'Search Results | E-Flora')

@section('content')
<style>
    .custom-card {
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
        padding: 10px;
        border-radius: 10px;
        background: white;
        transition: all 0.3s ease;
        height: 100%;
    }
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: rgba(17, 17, 26, 0.2) 0px 4px 24px;
    }
    .plant-img {
        height: 220px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }
    .plant-type { font-size: 0.85rem; font-weight: 600; text-transform: uppercase; }
    .type-family { color: #f57c00; } /* Orange */
    .type-genus { color: #007bff; } /* Blue */
    .type-species { color: #198754; } /* Green */
</style>


<!-- 🌿 Banner -->
<section class="d-flex align-items-center text-white position-relative"
    style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
    <div class="container position-relative text-center py-5">
        <h1 class="display-5 fw-bold text-white">Search Results</h1>
        <p class="lead mb-0">Explore Families, Genera, and Species that match your keyword</p>
    </div>
</section>

<!-- 🔍 Search Box -->
<section class="py-4 bg-light border-bottom">
    <div class="container">
        {{-- <form action="{{ route('search') }}" method="GET" class="row g-3 justify-content-center">
            @csrf
            <div class="col-12 col-sm-6 col-md-4">
                <div class="position-relative">
                    <input type="text" id="searchInput" name="q" class="form-control"
                        placeholder="Enter keyword..." value="{{ request('q') }}" autocomplete="off">
                    <ul id="suggestions" class="list-group position-absolute w-100 shadow-sm d-none"
                        style="z-index: 1000; max-height: 200px; overflow-y: auto;"></ul>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success"><i class="bi bi-search me-2"></i>Search</button>
            </div>
        </form> --}}
         <form action="{{ route('search') }}" method="GET"
                class="row justify-content-center position-relative mt-4 hero-search-form">
                {{-- @csrf --}}
                <div class="col-12 col-md-6 mt-3">
                    {{-- <div class="input-group position-relative  mb-3 justify-content-center">

                        <input type="radio" id="type_search"  name="plant_type" value="non-flowering">&nbsp;&nbsp; Flora of India&nbsp;&nbsp;
                        <input type="radio"  id="type_search" name="plant_type" value="flowering" checked>&nbsp;&nbsp; Plant Checklist of
                        India &nbsp;&nbsp;

                    </div> --}}

                    <div class="input-group position-relative mb-3 justify-content-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="floraOfIndia" name="plant_type"
                                value="flora_india"     {{ $searchType == 'flora_india' ? 'checked' : '' }}>
                            <label class="form-check-label flora-label" for="floraOfIndia">Flora of India</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="plantChecklist" name="plant_type"
                                value="checklist"     {{ $searchType == 'checklist' ? 'checked' : '' }}>
                            <label class="form-check-label flora-label" for="plantChecklist">Plant Checklist of India</label>
                        </div>
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

<!-- 🌸 Results -->
<section class="py-5">
    <div class="container">

        {{-- Families --}}
        @if($families->count())
        <h3 class="mb-4 text-warning fw-bold border-bottom pb-2">FAMILIES</h3>
        <div class="row g-4">
            @foreach ($families as $f)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="custom-card">
                    <a href="{{ route('get.family', ['family' => $f->family_code]) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('storage/images/species.jpg') }}" class="plant-img w-100" alt="">
                        <div class="p-3">
                            <div class="plant-type type-family">🌿 Family</div>
                            <h5>{{ $f->name }}</h5>
                            <p><small>{{ $f->description }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $families->withQueryString()->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif

        {{-- Genus --}}
        @if($genus->count())
        <h3 class="mt-5 mb-4 text-primary fw-bold border-bottom pb-2">GENUS</h3>
        <div class="row g-4">
            @foreach ($genus as $g)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="custom-card">
                    <a href="#" class="text-decoration-none text-dark">
                        <img src="{{ asset('storage/images/species.jpg') }}" class="plant-img w-100" alt="">
                        <div class="p-3">
                            <div class="plant-type type-genus">🌿 Genus</div>
                            <h5>{{ $g->name }}</h5>
                            <p><small>{{ $g->description }} {{ $g->family->name ?? '' }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $genus->withQueryString()->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif

        {{-- Species --}}
        @if($species->count())
        <h3 class="mt-5 mb-4 text-success fw-bold border-bottom pb-2">SPECIES</h3>
        <div class="row g-4">
            @foreach ($species as $s)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="custom-card">
                    <a href="{{ route('get.species', ['species' => $s->species_code]) }}" class="text-decoration-none text-dark">
                        <img src="{{ $s->images->first()? asset('storage/plants/'.$s->images->first()->pic) : asset('storage/images/species.jpg') }}"
                            class="plant-img w-100" alt="{{ $s->name }}">
                        <div class="p-3">
                            <div class="plant-type type-species">🌿 Species</div>
                            <h5>{{ $s->name }}</h5>
                            <p><small>{{ $s->family->name ?? '' }} {{ $s->genus->name ?? '' }}</small></p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $species->withQueryString()->links('vendor.pagination.bootstrap-4') }}
        </div>
        @endif

        @if(!$families->count() && !$genus->count() && !$species->count())
        <div class="alert alert-warning text-center mt-5">No results found for "{{ $keyword }}".</div>
        @endif

    </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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
        const url = `{{ route('search.suggest') }}?q=${encodeURIComponent(query)}&plant_type=${encodeURIComponent(plantType)}`;

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
                        header.className = "list-group-item flora-active fw-bold text-uppercase";
                        header.textContent = type;
                        suggestionsBox.appendChild(header);

                        data[type].forEach(item => {
                            const li = document.createElement("li");
                            li.className = "list-group-item list-group-item-action";
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

