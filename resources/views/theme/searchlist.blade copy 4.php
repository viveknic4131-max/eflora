@extends('theme.layouts.app')

@section('title', 'Search Results | E-Flora')

@section('content')
<style>
    /* 🌿 Card styling */
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

    .plant-type {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .type-family {
        color: #f57c00;
    }

    .type-genus {
        color: #007bff;
    }

    .type-species {
        color: #198754;
    }

    /* 🌱 Search Banner Styling */
    .search-banner {
        background: linear-gradient(135deg, #f8fff8 0%, #eaf5ea 100%);
        border-bottom: 1px solid #e2e2e2;
    }

    .search-banner h2 {
        font-size: 2.2rem;
        color: #2d5a27;
        letter-spacing: 0.5px;
    }

    .search-form {
        max-width: 700px;
    }

    #tagContainer {
        background-color: #fff;
        border: 2px solid #cde3cd;
        transition: all 0.3s ease;
    }

    #tagContainer:focus-within {
        border-color: #5fa45f;
        box-shadow: 0 0 10px rgba(95, 164, 95, 0.3);
    }

    #tagContainer input {
        outline: none;
        border: none;
        font-size: 1rem;
        background: transparent;
    }

    #suggestions li {
        cursor: pointer;
        transition: background 0.2s ease;
    }

    #suggestions li:hover {
        background-color: #f3f8f3;
    }

    .form-check-label {
        font-size: 1rem;
        color: #3a3a3a;
        cursor: pointer;
        transition: color 0.2s;
    }

    .form-check-input:checked+.form-check-label {
        color: #2d7a2d;
        font-weight: 600;
    }

    .form-check-input {
        accent-color: #2d7a2d;
    }
</style>

<!-- 🌿 Banner -->
<section class="d-flex align-items-center text-white position-relative"
    style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
    <div class="container-fluid position-relative text-center py-5">
        <h1 class="display-5 fw-bold text-white">Search Results</h1>
        <p class="lead mb-0">Explore Families, Genera, and Species that match your keyword</p>
    </div>
</section>

<!-- 🌸 Search Section -->
<section class="search-banner py-5 border-bottom">
    <div class="container text-center">
        <h2 class="fw-bold mb-3 text-dark">Search Results</h2>
        <p class="text-muted mb-4">Explore Families, Genera, and Species that match your keyword</p>

        <form action="{{ route('search') }}" method="GET" class="search-form mx-auto">

            <!-- Radio Buttons -->
            <div class="mb-3 d-flex justify-content-center align-items-center gap-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="floraOfIndia" name="plant_type"
                        value="flora_india" {{ $searchType == 'flora_india' ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="floraOfIndia">Flora of India</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="plantChecklist" name="plant_type"
                        value="checklist" {{ $searchType == 'checklist' ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="plantChecklist">Plant Checklist of India</label>
                </div>
            </div>

            <!-- Multi Tag Input + Search Button -->
            <div class="search-box position-relative mx-auto d-flex align-items-center">
                <div id="tagContainer"
                    class="form-control form-control-lg rounded-pill shadow-sm d-flex flex-wrap align-items-center gap-2 px-3"
                    style="cursor: text; flex: 1;">
                    <input type="text" id="searchInput" class="border-0 flex-grow-1"
                        placeholder="Search for plants, species..." autocomplete="off" style="min-width: 120px;">
                </div>

                <button type="submit"
                    class="btn btn-success btn-lg rounded-circle d-flex align-items-center justify-content-center shadow-sm ms-3"
                    style="width: 52px; height: 52px;">
                    <i class="bi bi-search fs-4 text-white"></i>
                </button>

                <!-- Suggestions -->
                <ul id="suggestions" class="list-group position-absolute w-100 d-none mt-2 shadow-sm rounded-4"
                    style="z-index: 1000; max-height: 300px; overflow-y: auto; top: 100%;">
                </ul>

                <!-- Hidden Input for Laravel -->
                <input type="hidden" name="q" id="hiddenInput">
            </div>
        </form>
    </div>
</section>

<!-- 🌸 Search Results -->
<section class="py-5">
    <div class="container">
        @if (!empty($data) && count($data) > 0)
        @php $grouped = collect($data)->groupBy('type'); @endphp

        @foreach ($grouped as $type => $plants)
        <div class="mb-5">
            <h3 class="mb-4 fw-bold border-bottom pb-2
                            {{ strtolower($type) == 'family'
                                ? 'text-warning'
                                : (strtolower($type) == 'genus'
                                    ? 'text-primary'
                                    : 'text-success') }}">
                {{ strtoupper($type) }}
            </h3>

            <div class="row g-4">
                @foreach ($plants as $plant)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="custom-card h-100">
                        <a href="#" class="text-decoration-none text-dark">
                            @if (!empty($plant['images']))
                            <img src="{{ asset('storage/plants/' . $plant['images']) }}"
                                class="plant-img w-100" alt="{{ $plant['name'] }}">
                            @else
                            <img src="{{ asset('storage/images/species.jpg') }}" class="plant-img w-100"
                                alt="No Image">
                            @endif

                            <div class="p-3">
                                <div class="plant-type
                                                    {{ strtolower($plant['type']) == 'family'
                                                        ? 'type-family'
                                                        : (strtolower($plant['type']) == 'genus'
                                                            ? 'type-genus'
                                                            : 'type-species') }}">
                                    🌿 {{ $plant['type'] }}
                                </div>
                                <h5 class="card-title mb-2">{{ $plant['name'] }}</h5>

                                @if ($plant['type'] == 'Family')
                                <p class="card-text mb-1">
                                    <a href="{{ route('get.family', ['family' => $plant['id']]) }}">
                                        <small class="text-muted">{{ $plant['details'] }}</small>
                                    </a>
                                </p>
                                @elseif ($plant['type'] == 'Genus')
                                <p class="card-text mb-1">
                                    <a href="#"><small
                                            class="text-muted">{{ $plant['details'] }}</small></a>
                                </p>
                                @elseif ($plant['type'] == 'Species')
                                <p class="card-text mb-1">
                                    <a href="{{ route('get.species', ['species' => $plant['id']]) }}">
                                        <small class="text-muted">{{ $plant['details'] }}</small>
                                    </a>
                                </p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        @else
        <div class="alert alert-warning text-center">
            No results found for your search.
        </div>
        @endif
    </div>
</section>

<!-- 🌿 JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tagContainer = document.getElementById('tagContainer');
        const input = document.getElementById('searchInput');
        const hiddenInput = document.getElementById('hiddenInput');
        const suggestionsBox = document.getElementById('suggestions');
        let tags = [];

        function addTag(tagText) {
            const text = tagText.trim();
            if (text && !tags.includes(text)) {
                tags.push(text);
                renderTags();
                input.value = '';
                updateHiddenInput();
            }
        }

        function removeTag(index) {
            tags.splice(index, 1);
            renderTags();
            updateHiddenInput();
        }

        function renderTags() {
            tagContainer.innerHTML = '';
            tags.forEach((tag, index) => {
                const tagEl = document.createElement('span');
                tagEl.className =
                    'badge rounded-pill bg-success text-light px-3 py-2 d-flex align-items-center';
                tagEl.innerHTML = `
                        ${tag}
                        <button type="button" class="btn-close btn-close-white btn-sm ms-2" aria-label="Remove"></button>
                    `;
                tagEl.querySelector('button').addEventListener('click', () => removeTag(index));
                tagContainer.appendChild(tagEl);
            });
            tagContainer.appendChild(input);
            input.focus();
        }

        function updateHiddenInput() {
            hiddenInput.value = tags.join(',');
        }

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                addTag(input.value);
            }
        });

        input.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length < 2) {
                suggestionsBox.classList.add('d-none');
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
                            const header = document.createElement('li');
                            header.className = "list-group-item active fw-bold text-uppercase";
                            header.textContent = type;
                            suggestionsBox.appendChild(header);

                            data[type].forEach(item => {
                                const li = document.createElement('li');
                                li.className = "list-group-item list-group-item-action";
                                li.textContent = item.name;
                                li.addEventListener('click', () => {
                                    addTag(item.name);
                                    suggestionsBox.classList.add('d-none');
                                });
                                suggestionsBox.appendChild(li);
                            });
                        }
                    });

                    if (hasResults) suggestionsBox.classList.remove('d-none');
                    else suggestionsBox.classList.add('d-none');
                })
                .catch(() => suggestionsBox.classList.add('d-none'));
        });

        document.addEventListener('click', (e) => {
            if (!suggestionsBox.contains(e.target) && e.target !== input) {
                suggestionsBox.classList.add('d-none');
            }
        });
    });
</script>
@endsection
