@extends('theme.layouts.app')

@section('title', isset($family) ? $family->name . ' | E-Flora' : ($volume->volume ?? 'Flora') . ' | E-Flora')

@section('content')

    {{-- 🌿 If viewing a Volume --}}
    @if ($mode === 'volume')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $volume->volume }}</h1>
                <p class="lead mb-4">Select a Family to Explore</p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-success text-white text-center fw-semibold rounded-top">
                                Families in {{ $volume->volume }}
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @foreach ($families as $family)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-semibold text-success">{{ $family->name }}</span>
                                            <a href="{{ route('get.family', ['family' => $family->family_code]) }}"
                                                class="btn btn-outline-success btn-sm rounded-pill px-3">
                                                View Details
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 🌱 Family Mode --}}
    @elseif ($mode === 'family')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $family->name }}</h1>
                <p class="lead mb-4">Explore genus and species under this family</p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success text-uppercase">{{ $family->name }}</h2>
                    <p class="text-muted">Explore genus and species under this family 🌿</p>
                </div>

                <div class="row g-4">
                    {{-- 🌿 Family Info --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body text-center">
                                <h4 class="fw-bold text-success mb-3">Family</h4>
                                <h5 class="text-dark">{{ $family->name ?? 'No description available.' }}</h5>
                                <p class="fst-italic text-muted small mb-0">
                                    {{ $family->description ?? 'No description available.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- 🌱 Genus Column --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h4 class="fw-bold text-success text-center mb-3">Genus</h4>

                                <form method="GET" action="{{ route('get.family') }}" class="d-flex mb-3">
                                    <input type="hidden" name="family" value="{{ $family->family_code }}">
                                    @if (request()->filled('species_search'))
                                        <input type="hidden" name="species_search"
                                            value="{{ request('species_search') }}">
                                    @endif
                                    <input type="text" name="genus_search" class="form-control me-2"
                                        placeholder="Search Genus..." value="{{ request('genus_search') }}">
                                    @if (request()->filled('genus_search'))
                                        <a href="{{ route('get.family', ['family' => $family->family_code, 'species_search' => request('species_search')]) }}"
                                            class="btn btn-outline-danger">×</a>
                                    @endif
                                </form>

                                <div class="scrollable-column flex-grow-1">
                                    <ul class="list-unstyled mb-0">
                                        @forelse ($genusList as $genus)
                                            @php
                                                $isSelected =
                                                    isset($selectedGenus) && $selectedGenus->id === $genus->id;
                                            @endphp
                                            <li class="mb-2">
                                                <a href="?family={{ $family->family_code }}&genus={{ $genus->genus_code }}"
                                                    class="text-decoration-none fw-semibold {{ $isSelected ? 'text-danger' : 'text-success' }}">
                                                    🌱 {{ $genus->name }}
                                                </a>
                                                {{-- @if ($isSelected)
                                                    <span class="badge bg-primary ms-1">Selected</span>
                                                @endif --}}
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

                    {{-- 🌸 Species Column --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h4 class="fw-bold text-success text-center mb-3">Species</h4>

                                {{-- Selected Genus Alert --}}
                                @if (isset($selectedGenus))
                                    <div class="alert alert-info text-center rounded-4 py-2 mb-3">
                                        Showing species under <strong>{{ $selectedGenus->name }}</strong>
                                        <a href="?family={{ $family->family_code }}"
                                            class="ms-2 text-decoration-none text-danger">
                                            Clear
                                        </a>
                                    </div>
                                @endif

                                <form method="GET" action="{{ route('get.family') }}" class="d-flex mb-3">
                                    <input type="hidden" name="family" value="{{ $family->family_code }}">
                                    @if (isset($selectedGenus))
                                        <input type="hidden" name="genus" value="{{ $selectedGenus->genus_code }}">
                                    @endif
                                    <input type="text" name="species_search" class="form-control me-2"
                                        placeholder="Search Species..." value="{{ request('species_search') }}">
                                    @if (request()->filled('species_search'))
                                        <a href="{{ route('get.family', ['family' => $family->family_code, 'genus' => request('genus')]) }}"
                                            class="btn btn-outline-danger">×</a>
                                    @endif
                                </form>

                                <div class="scrollable-column flex-grow-1">
                                    <ul class="list-unstyled mb-0">
                                        @forelse ($speciesList as $species)
                                            <li class="mb-3">
                                                <a href="{{ route('get.species', ['species' => $species->species_code]) }}"
                                                    class="text-decoration-none text-success fw-semibold d-block">
                                                    {{ $species->name }}
                                                </a>
                                                <small class="text-muted d-block">
                                                    <b>Genus:</b> {{ $species->genus->name ?? '-' }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <b>Volume:</b> {{ $species->volume ?? '-' }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <b>Page No:</b> {{ $species->page ?? '-' }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <b>Author:</b> {{ $species->author ?? '-' }}
                                                </small>
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
    @elseif ($mode === 'genus')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $genus->name }}</h1>
                <p class="lead mb-4">Explore species under this genus</p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success text-uppercase">{{ $genus->name }}</h2>
                    <p class="text-muted">All species under the genus <strong>{{ $genus->name }}</strong></p>
                </div>

                <div class="row g-4">
                    {{-- 🌿 Family Info --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body text-center">
                                <h4 class="fw-bold text-success mb-3">Family</h4>
                                <h5 class="text-dark">{{ $family->name }}</h5>
                                <p class="fst-italic text-muted small mb-0">
                                    {{ $family->description ?? 'No description available.' }}
                                </p>
                                {{-- <a href="{{ route('get.family', ['family' => $family->family_code]) }}"
                                    class="btn btn-outline-success mt-2 rounded-pill px-3">
                                    View Family
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    {{-- 🌱 Genus Info --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body text-center">
                                <h4 class="fw-bold text-success mb-3">Genus</h4>
                                <h5 class="text-dark">{{ $genus->name }}</h5>
                                <p class="fst-italic text-muted small mb-0">
                                    {{ $genus->description ?? 'No description available.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- 🌸 Species List --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="card shadow-sm h-100 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h4 class="fw-bold text-success text-center mb-3">Species</h4>

                                <div class="scrollable-column flex-grow-1">
                                    <ul class="list-unstyled mb-0">
                                        @forelse ($speciesList as $species)
                                            <li class="mb-3">
                                                <a href="{{ route('get.species', ['species' => $species->species_code]) }}"
                                                    class="text-decoration-none text-success fw-semibold d-block">
                                                    {{ $species->name }}
                                                </a>
                                                <small class="text-muted d-block">
                                                    <b>Author:</b> {{ $species->author ?? '-' }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <b>Volume:</b> {{ $species->volume ?? '-' }}
                                                </small>
                                                <small class="text-muted d-block">
                                                    <b>Page:</b> {{ $species->page ?? '-' }}
                                                </small>
                                            </li>
                                        @empty
                                            <li class="text-muted">No species found for this genus.</li>
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
    @endif
@endsection
