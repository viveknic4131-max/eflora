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

        .plant-type {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .type-family {
            color: #f57c00;
        }

        /* Orange */
        .type-genus {
            color: #007bff;
        }

        /* Blue */
        .type-species {
            color: #198754;
        }

        /* Green */
    </style>

    <!-- 🌿 Banner Section -->
    <section class="d-flex align-items-center text-white position-relative"
        style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container-fluid position-relative text-center py-5">
            <h1 class="display-5 fw-bold text-white">Search Results</h1>
            <p class="lead mb-0">Explore Families, Genera, and Species that match your keyword</p>
        </div>
    </section>

    <!-- 🔎 Filter/Search Section -->
    <section class="py-4 bg-light border-bottom">
        <div class="container-fluid">
            <form action="{{ route('search') }}" method="POST"
                class="row g-2 g-md-3 align-items-end justify-content-center">
                @csrf
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="position-relative">
                        <input type="text" id="searchInput" name="q" class="form-control"
                            placeholder="Enter keyword..." value="{{ request('q') }}" autocomplete="off">
                        <ul id="suggestions" class="list-group position-absolute w-100 shadow-sm d-none"
                            style="z-index: 1000; max-height: 200px; overflow-y: auto;"></ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- 🌸 Search Results -->
    <section class="py-5">
        <div class="container-fluid">
            @if (!empty($data) && count($data) > 0)
                @php
                    $grouped = collect($data)->groupBy('type');
                @endphp

                @foreach ($grouped as $type => $plants)
                    <div class="mb-5">
                        <h3
                            class="mb-4 fw-bold border-bottom pb-2
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
                                                <div
                                                    class="plant-type
                                                {{ strtolower($plant['type']) == 'family'
                                                    ? 'type-family'
                                                    : (strtolower($plant['type']) == 'genus'
                                                        ? 'type-genus'
                                                        : 'type-species') }}">
                                                    🌿 {{ $plant['type'] }}
                                                </div>
                                                <h5 class="card-title mb-2">{{ $plant['name'] }}</h5>
                                                @php
                                                    // dd($plant['type'] == 'family');
                                                @endphp
                                                @if ($plant['type'] == 'Family')
                                                    <p class="card-text mb-1">
                                                        <a href="{{route('get.family',['family'=>$plant['id'] ])}}"> <small class="text-muted"> {{ $plant['details'] }}</small> </a>
                                                    </p>
                                                @endif

                                                @if ($plant['type'] == 'Genus')
                                                    <p class="card-text mb-1">
                                                      <a href="#"> <small class="text-muted"> {{ $plant['details'] }}</small> </a>
                                                    </p>
                                                @endif
                                                @if ($plant['type'] == 'Species')
                                                    <p class="card-text mb-1">
                                                        <a href="">
                                                       <a href="{{ route('get.species', ['species' => $plant['id']]) }}"> <small class="text-muted"> {{ $plant['details'] }}</small> </a>
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

@endsection

@push('scripts')
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

                fetch(`{{ route('search.suggest') }}?q=${query}`)
                    .then(res => res.json())
                    .then(data => {
                        suggestionsBox.innerHTML = '';
                        Object.keys(data).forEach(type => {
                            const groupTitle = document.createElement("li");
                            groupTitle.className =
                                "list-group-item active text-uppercase fw-bold";
                            groupTitle.textContent = type;
                            suggestionsBox.appendChild(groupTitle);

                            data[type].forEach(item => {
                                const li = document.createElement("li");
                                li.className = "list-group-item list-group-item-action";
                                li.textContent = item.name;
                                li.onclick = () => {
                                    input.value = item.name;
                                    suggestionsBox.classList.add("d-none");
                                };
                                suggestionsBox.appendChild(li);
                            });
                        });
                        suggestionsBox.classList.remove("d-none");
                    });
            });

            document.addEventListener("click", e => {
                if (!suggestionsBox.contains(e.target) && e.target !== input) {
                    suggestionsBox.classList.add("d-none");
                }
            });
        });
    </script>
@endpush
