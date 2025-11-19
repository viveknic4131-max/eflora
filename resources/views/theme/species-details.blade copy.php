@extends('theme.layouts.app')

@section('title', $species->name . ' | E-Flora')

@section('content')
<style>
    .species-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('{{ asset("storage/plants/" . ($species->image ?? "default.jpg")) }}') center/cover no-repeat;
        color: #fff;
        text-align: center;
        padding: 100px 20px;
    }

    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .details-list {
        list-style: none;
        padding: 0;
    }

    .details-list li {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .details-list strong {
        width: 160px;
        display: inline-block;
        color: #198754;
    }

    .synonyms span {
        background-color: #e9f7ef;
        color: #198754;
        padding: 5px 10px;
        border-radius: 10px;
        margin-right: 5px;
        display: inline-block;
    }
</style>

{{-- <!-- 🌿 Hero Section -->
<section class="species-hero">
    <div class="container">
        <h1 class="fw-bold display-5">{{ $species->name }}</h1>

</div>
</section> --}}

@php

@endphp

<section class="d-flex align-items-center text-white position-relative"
    style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
    <div class="container position-relative text-center py-5">
        <h1 class="display-5 fw-bold text-white">{{ $species->name }}</h1>
        <p class="lead fst-italic">{{ $species->common_name ?? 'No common name available.' }}</p>
    </div>
</section>

<!-- 🌱 Species Details -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 align-items-start">

            <!-- 🖼️ Image -->
            <div class="col-md-5">
                <div class="card overflow-hidden">

                    @if(count($species->images)>0 && !empty($species->images) && file_exists(public_path('storage/plants/' . $species->images->pluck('pic')[0])))
                    <img src="{{ asset('storage/plants/' . $species->images->pluck('pic')[0]) }}"
                        class="img-fluid rounded" alt="{{ $species->name }}">
                    @else
                    <img src="{{ asset('images/as.jpg') }}"
                        class="img-fluid rounded" alt="No image available">
                    @endif
                </div>
            </div>

            <!-- 📘 Details -->
            <div class="col-md-7">
                <div class="card p-4">
                    <h3 class="fw-bold text-success mb-4">Species Information</h3>
                    <ul class="details-list">
                        <li><strong>Scientific Name:</strong> {{ $species->name }}</li>
                        <li><strong>Author:</strong> {{ $species->author ?? '—' }}</li>
                        <li><strong>Publication:</strong> {{ $species->publication ?? '—' }}</li>
                        <li><strong>Year Described:</strong> {{ $species->year_described ?? '—' }}</li>
                        <li><strong>Volume:</strong> {{ $species->volume ?? '—' }}</li>
                        <li><strong>Page:</strong> {{ $species->page ?? '—' }}</li>
                        <li><strong>Family:</strong> {{ $species->family->name ?? '—' }}</li>
                        <li><strong>Genus:</strong> {{ $species->genus->name ?? '—' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 📖 Description -->
        <div class="card mt-5 p-4">
            <h4 class="fw-bold text-success mb-3">Description</h4>
            <p class="text-muted" style="text-align: justify;">
                {{ $species->description ?? 'No description available.' }}
            </p>
        </div>

        <!-- 🌼 Synonyms -->
        @if(!empty($species->synonyms))
        <div class="card mt-4 p-4">
            <h4 class="fw-bold text-success mb-3">Synonyms</h4>
            <div class="synonyms">
                @foreach(json_decode($species->synonyms, true) as $syn)
                <span>{{ $syn }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- 📅 Footer Info -->
        <div class="text-center mt-5 text-muted small">
            <p>Added on {{ $species->created_at->format('d M Y') }} | Last updated {{ $species->updated_at->diffForHumans() }}</p>
        </div>
    </div>
</section>
@endsection
