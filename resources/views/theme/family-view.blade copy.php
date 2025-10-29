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
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
</style>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-success text-center mb-4 text-uppercase">{{ $family->name }}</h2>
        <p class="text-center mb-5 text-muted">Explore genus and species under this family 🌿</p>

        <div class="row g-4">
            <!-- Family Column -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="fw-bold text-success mb-3">Family</h4>
                        <p class="lead text-muted">{{ $family->description ?? 'No description available.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Genus Column -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="fw-bold text-success mb-3 text-center">Genus</h4>

                        <form method="GET" action="{{ route('get.family') }}" class="mb-3">
                            <input type="hidden" name="family" value="{{ $family->family_code }}">
                            <input type="text" name="genus_search" class="form-control"
                                   placeholder="Search Genus..." value="{{ request('genus_search') }}">
                        </form>

                        <div class="scrollable-column">
                            <ul class="list-unstyled">
                                @forelse ($genusList as $genus)
                                    <li class="mb-2">
                                        <a href="?family={{ $family->family_code }}&genus_search={{ $genus->name }}"
                                           class="text-decoration-none text-success d-block">
                                           🌱 {{ $genus->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-muted">No genus found.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Species Column -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="fw-bold text-success mb-3 text-center">Species</h4>

                        <form method="GET" action="{{ route('get.family') }}" class="mb-3">
                            <input type="hidden" name="family" value="{{ $family->family_code }}">
                            <input type="text" name="species_search" class="form-control"
                                   placeholder="Search Species..." value="{{ request('species_search') }}">
                        </form>

                        <div class="scrollable-column">
                            <ul class="list-unstyled">
                                @forelse ($speciesList as $species)
                                    <li class="mb-2">
                                        <span class="text-success fw-semibold">{{ $species->name }}</span>
                                        <br>
                                        <small class="text-muted">Genus: {{ $species->genus->name ?? '-' }}</small>
                                    </li>
                                @empty
                                    <li class="text-muted">No species found.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
