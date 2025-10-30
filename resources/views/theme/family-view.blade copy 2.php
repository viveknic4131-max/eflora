@extends('theme.layouts.app')

@section('title', $family->name . ' | E-Flora')

@section('content')
    <style>
        .scrollable-column {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }
    </style>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold text-success text-center mb-4 text-uppercase">{{ $family->name }}</h2>
            <p class="text-center mb-5 text-muted">Explore genus and species under this family 🌿</p>

            <div class="row g-4">
                <!-- 🌸 Family Column -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h4 class="fw-bold text-success mb-3">Family</h4>
                            <h5 class="lead text-bold">{{ $family->name ?? 'No description available.' }}</h5>
                            <p style="font-style: italic;">{{ $family->description ?? 'No description available.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 🌱 Genus Column -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="fw-bold text-success mb-3 text-center">Genus</h4>

                            <form method="GET" action="{{ route('get.family') }}" class="mb-3 d-flex">
                                <input type="hidden" name="family" value="{{ $family->family_code }}">

                                {{-- Keep species search only if exists --}}
                                @if (request()->filled('species_search'))
                                    <input type="hidden" name="species_search" value="{{ request('species_search') }}">
                                @endif

                                <input type="text" name="genus_search" class="form-control me-2"
                                    placeholder="Search Genus..." value="{{ request('genus_search') }}">

                                @if (request()->filled('genus_search'))
                                    <a href="{{ route('get.family', ['family' => $family->family_code, 'species_search' => request('species_search')]) }}"
                                        class="btn btn-outline-danger">×</a>
                                @endif
                            </form>

                            <div class="scrollable-column">
                                <ul class="list-unstyled">
                                    @forelse ($genusList as $genus)
                                        <li class="mb-2">
                                            <a href="?family={{ $family->family_code }}
                                            @if (request()->filled('species_search')) &species_search={{ request('species_search') }} @endif
                                            &genus_search={{ $genus->name }}"
                                                class="text-decoration-none text-success d-block">
                                                🌱 {{ $genus->name }}
                                            </a>
                                        </li>
                                    @empty
                                        <li class="text-muted">No genus found.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="mt-3">
                                {{ $genusList->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🌿 Species Column -->
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="fw-bold text-success mb-3 text-center">Species</h4>

                            <form method="GET" action="{{ route('get.family') }}" class="mb-3 d-flex">
                                <input type="hidden" name="family" value="{{ $family->family_code }}">

                                {{-- Keep genus search only if exists --}}
                                @if (request()->filled('genus_search'))
                                    <input type="hidden" name="genus_search" value="{{ request('genus_search') }}">
                                @endif

                                <input type="text" name="species_search" class="form-control me-2"
                                    placeholder="Search Species..." value="{{ request('species_search') }}">

                                @if (request()->filled('species_search'))
                                    <a href="{{ route('get.family', ['family' => $family->family_code, 'genus_search' => request('genus_search')]) }}"
                                        class="btn btn-outline-danger">×</a>
                                @endif
                            </form>

                            <div class="scrollable-column">
                                <ul class="list-unstyled">
                                    @forelse ($speciesList as $species)
                                        <li class="mb-2">
                                            <a href="{{ route('get.species', ['species' => $species->species_code]) }}"> <span
                                                    class="text-success fw-semibold">{{ $species->name }}</span><br> </a>
                                            <small class="text-muted"><b>Genus:</b>
                                                {{ $species->genus->name ?? '-' }}</small>
                                            <small class="text-muted"><b>Volume:</b> {{ $species->volume ?? '-' }}</small>

                                            <small class="text-muted"><b>Page No: </b> {{ $species->page ?? '-' }}</small>
                                            <small class="text-muted"><b>Author:</b> {{ $species->author ?? '-' }}</small>
                                        </li>
                                    @empty
                                        <li class="text-muted">No species found.</li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="mt-3">
                                {{ $speciesList->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
