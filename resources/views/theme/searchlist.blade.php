@extends('theme.layouts.app')

@section('title', 'Search Results | E-Flora')

@section('content')

    <!-- 🌿 Banner -->
    <section class="d-flex align-items-center text-white position-relative"
        style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 510px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container position-relative text-center py-5">
            <h1 class="display-5 fw-bold text-white">Search Results</h1>
            <p class="lead mb-4">Explore Families, Genera, and Species that match your keyword</p>

            <form action="{{ route('search') }}" method="GET" class="search-form mx-auto"
                style="max-width: 800px; position: relative;">

                <!-- Radio Buttons -->
                <div class="mb-3 d-flex flex-wrap justify-content-center align-items-center gap-3">
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

                <!-- Search Box -->
                <div class="d-flex">
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-3 position-relative"
                        style="flex-grow: 1">
                        <div id="tagContainer"
                            class="form-control form-control-lg rounded-pill shadow-sm d-flex flex-wrap align-items-center gap-2 px-3 flex-grow-1"
                            style="cursor: text; min-width: 240px;">
                            <input type="text" id="searchInput" class="border-0 flex-grow-1 bg-transparent"
                                placeholder="Search for plants, species..." autocomplete="off">
                        </div>
                        <ul id="suggestions"
                            class="list-group position-absolute start-0 end-0 mx-auto d-none mt-2 shadow-sm rounded-4 bg-white"
                            style="z-index: 1050; max-height: 300px; overflow-y: auto; width: 75%; top: 100%;">
                        </ul>





                        <input type="hidden" name="q" id="hiddenInput" value="{{ request('q') }}">
                    </div>
                    <button type="submit"
                        class="btn btn-success btn-lg rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-search fs-4 text-white"></i>
                    </button>
                </div>
            </form>

        </div>
    </section>

    <!-- 🌸 Search Results -->
    <section class="search-section py-5 bg-light">
        <div class="container">
            @if ($data->count() > 0)
                <div class="row g-4">
                    @foreach ($data as $plant)
                        @php
                            $link =
                                strtolower($plant['type']) === 'family'
                                    ? route('get.family', ['family' => $plant['id']])
                                    : (strtolower($plant['type']) === 'species'
                                        ? route('get.species', ['species' => $plant['id']])
                                        : '#');
                        @endphp

                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                            <a href="{{ $link }}"
                                class="card text-dark text-decoration-none flex-fill shadow-sm border-0 rounded-4 overflow-hidden">
                                @if (!empty($plant['images']))
                                    <img src="{{ asset('storage/plants/' . $plant['images']) }}"
                                        class="card-img-top img-fluid" alt="{{ $plant['name'] }}">
                                @else
                                    <img src="{{ asset('storage/images/species.jpg') }}" class="card-img-top img-fluid"
                                        alt="No Image">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span
                                            class="badge
                                        @if (strtolower($plant['type']) == 'family') bg-success
                                        @elseif (strtolower($plant['type']) == 'genus') bg-primary
                                        @else bg-info text-dark @endif">
                                            🌿 {{ $plant['type'] }}
                                        </span>
                                    </div>
                                    <h5 class="card-title text-truncate mb-2">{{ $plant['name'] }}</h5>
                                    <p class="card-text text-muted small mb-0 text-truncate">{{ $plant['details'] }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-warning text-center">
                    No results found for your search.
                </div>
            @endif
        </div>
    </section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tagContainer = document.getElementById('tagContainer');
        const input = document.getElementById('searchInput');
        const hiddenInput = document.getElementById('hiddenInput');
        const suggestionsBox = document.getElementById('suggestions');
        let tags = [];

        // ✅ Initialize tags if there’s already a value in hiddenInput (like "Suntaceae,faf,Deleniti spkfaf")
        if (hiddenInput.value) {
            tags = hiddenInput.value.split(',').map(t => t.trim()).filter(Boolean);
        }

        // ✅ Add new tag
        function addTag(tagText) {
            const text = tagText.trim();
            if (text && !tags.includes(text)) {
                tags.push(text);
                renderTags();
                input.value = '';
                updateHiddenInput();
            }
        }

        // ✅ Remove tag
        function removeTag(index) {
            tags.splice(index, 1);
            renderTags();
            updateHiddenInput();
        }

        // ✅ Render tags visually
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

        // ✅ Sync tags → hidden input (comma-separated)
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
                            header.className =
                                "list-group-item active fw-bold text-uppercase";
                            header.textContent = type;
                            suggestionsBox.appendChild(header);

                            data[type].forEach(item => {
                                const li = document.createElement('li');
                                li.className =
                                    "list-group-item list-group-item-action";
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

        renderTags();
    });
</script>
