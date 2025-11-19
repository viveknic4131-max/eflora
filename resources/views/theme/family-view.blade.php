@extends('theme.layouts.app')

@section('title', isset($family) ? $family->name . ' | E-Flora' : ($volume->volume ?? 'Flora') . ' | E-Flora')

@section('content')

    {{-- 🌿 VOLUME MODE --}}
    @if ($mode === 'volume')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $volume->volume }}</h1>
                <p class="lead mb-4">Select a Family to Explore</p>
            </div>
        </section>




        {{-- new  --}}

        <section class="py-5 bg-light search-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">{{ $volume->volume }}</h2>
                    {{-- <p class="text-muted">Family: <strong>{{ $family->name }}</strong></p> --}}
                </div>

                <form method="GET" class="row g-2 mb-4">
                    <input type="hidden" name="volume" value="{{ $volume->volume_code }}">
                    <div class="col-md-10">
                        <input type="text" name="family_search" class="form-control" placeholder="Search Family..."
                            value="{{ request('family_search') }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success w-100">Search</button>
                        @if (request()->filled('family_search'))
                            <a href="{{ route('get.family', ['family' => $family->family_code]) }}"
                                class="btn btn-outline-danger">×</a>
                        @endif
                    </div>
                </form>


                <div class="row g-2">
                    @forelse ($families as $family)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                            <a href="{{ route('get.family', ['family' => $family->family_code]) }}"
                                class="card card-genus text-dark text-decoration-none flex-fill shadow-sm border-0 rounded-4 overflow-hidden">
                                @if (!empty($species->images) && count($species->images) > 0)
                                    @php

                                        $firstImage = is_array($species->images)
                                            ? $species->images[0]
                                            : $species->images->first();

                                        // dd($firstImage->pic);

                                    @endphp

                                    <img src="{{ asset('storage/plants/' . $firstImage->pic) }}"
                                        class="card-img-top img-fluid" alt="{{ $species->name }}">
                                @else
                                    <img src="{{ asset('storage/images/species.jpg') }}" class="card-img-top img-fluid"
                                        alt="No Image">
                                @endif


                                <div class="card-body d-flex flex-column">
                                    {{-- <div class="mb-2">
                                        <span
                                            class="badge
                                        @if (strtolower($plant['type']) == 'family') bg-success
                                        @elseif (strtolower($plant['type']) == 'genus') bg-primary
                                        @else bg-info text-dark @endif">
                                            🌿 {{ $plant['type'] }}
                                        </span>
                                    </div> --}}
                                    <h6 class="card-title text-truncate mb-2">{{ $family->name }}</h6>
                                    {{-- <p class="card-text text-muted small mb-0 text-truncate">{{ $plant['details'] }}</p> --}}
                                    {{-- <p class="text-muted small mb-0">
                                        {{ $species->author ?? '-' }}<br>
                                        Vol: {{ $species->volume ?? '-' }}, Pg: {{ $species->page ?? '-' }}
                                    </p> --}}
                                </div>
                            </a>
                        </div>



                    @empty
                        <p class="text-center text-muted">No family found under this {{ $volume->volume }}.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $families->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>


        {{-- 🌱 FAMILY MODE --}}
    @elseif ($mode === 'family')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $family->name }}</h1>
                <p class="lead mb-0">Explore all genus under this family</p>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">{{ $family->name }}</h2>
                    <p class="text-muted">Click a genus to view its species 🌱</p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-3 ">
                    <form method="GET" class="row g-2 mb-4">
                        <input type="hidden" name="family" value="{{ $family->family_code }}">
                        <div class="col-md-10">
                            <input type="text" name="genus_search" class="form-control" placeholder="Search Genus..."
                                value="{{ request('genus_search') }}">
                        </div>
                        <div class="col-md-2 d-flex gap-2 ">
                            <button class="btn btn-success w-100">Search</button>
                            @if (request()->filled('genus_search'))
                                <a href="{{ route('get.family', ['family' => $family->family_code]) }}"
                                    class="btn btn-outline-danger">×</a>
                            @endif
                        </div>
                    </form>

                    <div class="row g-2">
                        @forelse ($genusList as $genus)
                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                                <a href="{{ route('get.family', ['genus' => $genus->genus_code]) }}"
                                    class="text-decoration-none">
                                    {{-- <div class="card h-100 border-0 shadow-sm rounded-4 text-center hover-shadow"> --}}
                                    <div class="card-genus">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <h6 class="fw-semibold text-success mb-0">{{ $genus->name }}</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-center text-muted">No genus found.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $genusList->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>

        {{-- 🌸 GENUS MODE --}}
    @elseif ($mode === 'genus')
        <section class="d-flex align-items-center text-white position-relative"
            style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
            <div class="container position-relative text-center py-5">
                <h1 class="display-5 fw-bold text-white">{{ $genus->name }}</h1>
                <p class="lead mb-0">Species under the genus {{ $genus->name }}</p>
            </div>
        </section>

        <section class="py-5 bg-light search-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-success">{{ $genus->name }}</h2>
                    <p class="text-muted">Family: <strong>{{ $family->name }}</strong></p>
                </div>

                <form method="GET" class="row g-2 mb-4">
                    <input type="hidden" name="genus" value="{{ $genus->genus_code }}">
                    <div class="col-md-10">
                        <input type="text" name="species_search" class="form-control" placeholder="Search Species..."
                            value="{{ request('species_search') }}">
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-success w-100">Search</button>
                        @if (request()->filled('species_search'))
                            <a href="{{ route('get.family', ['genus' => $genus->genus_code]) }}"
                                class="btn btn-outline-danger">×</a>
                        @endif
                    </div>
                </form>


                <div class="row g-2">
                    @forelse ($speciesList as $species)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                            <a href="{{ route('get.species', ['species' => $species->species_code]) }}"
                                class="card card-genus text-dark text-decoration-none flex-fill shadow-sm border-0 rounded-4 overflow-hidden">
                                @if (!empty($species->images) && count($species->images) > 0)
                                    @php

                                        $firstImage = is_array($species->images)
                                            ? $species->images[0]
                                            : $species->images->first();

                                        // dd($firstImage->pic);

                                    @endphp

                                    <img src="{{ asset('storage/plants/' . $firstImage->pic) }}"
                                        class="card-img-top img-fluid" alt="{{ $species->name }}">
                                @else
                                    <img src="{{ asset('storage/images/species.jpg') }}" class="card-img-top img-fluid"
                                        alt="No Image">
                                @endif


                                <div class="card-body d-flex flex-column">
                                    {{-- <div class="mb-2">
                                        <span
                                            class="badge
                                        @if (strtolower($plant['type']) == 'family') bg-success
                                        @elseif (strtolower($plant['type']) == 'genus') bg-primary
                                        @else bg-info text-dark @endif">
                                            🌿 {{ $plant['type'] }}
                                        </span>
                                    </div> --}}
                                    <h6 class="card-title text-truncate mb-2">{{ $species->name }}</h6>
                                    {{-- <p class="card-text text-muted small mb-0 text-truncate">{{ $plant['details'] }}</p> --}}
                                    <p class="text-muted small mb-0">
                                        {{ $species->author ?? '-' }}<br>
                                        Vol: {{ $species->volume ?? '-' }}, Pg: {{ $species->page ?? '-' }}
                                    </p>
                                </div>
                            </a>
                        </div>



                    @empty
                        <p class="text-center text-muted">No species found under this genus.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $speciesList->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    @endif

@endsection
