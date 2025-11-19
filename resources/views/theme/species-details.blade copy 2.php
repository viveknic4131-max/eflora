@extends('theme.layouts.app')

@section('title', $species->name . ' | E-Flora')

@section('content')

    <style>
        .thumb-img:hover {
            border-color: #198754;
            transform: scale(1.05);
        }

        .thumb-img.active-thumb {
            border: 2px solid #198754 !important;
        }

        .main-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }
    </style>

    <!-- 🌿 Header Section -->
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

                <!-- 🖼️ Image + Thumbnails -->
                <div class="col-md-5">
                    <div class="card p-2">

                        @php
                            $images = $species->images->pluck('pic')->toArray();
                            $main =
                                !empty($images) && file_exists(public_path('storage/plants/' . $images[0]))
                                    ? asset('storage/plants/' . $images[0])
                                    : asset('images/as.jpg');
                        @endphp

                        <!-- Main Image -->
                        <img id="mainImage" src="{{ $main }}" class="img-fluid rounded main-img mb-3"
                            alt="{{ $species->name }}">

                        <!-- Thumbnails -->
                        <div id="thumbnails" class="d-flex flex-wrap gap-2">
                            @foreach ($images as $img)
                                @if (file_exists(public_path('storage/plants/' . $img)))
                                    <img src="{{ asset('storage/plants/' . $img) }}" class="thumb-img"
                                        style="width:70px; height:70px; object-fit:cover; cursor:pointer; border-radius:6px; border:2px solid #eee;">
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>

                <!-- 📘 Species Details Text -->
                <div class="col-md-7">
                    <div class="card p-4">
                        <h3 class="fw-bold text-success mb-4">Species Information</h3>
                        <ul class="details-list list-unstyled">
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
            @if (!empty($species->synonyms))
                <div class="card mt-4 p-4">
                    <h4 class="fw-bold text-success mb-3">Synonyms</h4>
                    <div class="synonyms">
                        @foreach (json_decode($species->synonyms, true) as $syn)
                            <span
                                style="background:#e9f7ef; color:#198754; padding:5px 10px; border-radius:10px; margin-right:5px;">
                                {{ $syn }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 📅 Footer Info -->
            <div class="text-center mt-5 text-muted small">
                <p>Added on {{ $species->created_at->format('d M Y') }} |
                    Last updated {{ $species->updated_at->diffForHumans() }}</p>
            </div>

        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let mainImage = document.getElementById("mainImage");
            let thumbnails = document.querySelectorAll("#thumbnails img");

            if (thumbnails.length > 0) {
                thumbnails[0].classList.add("active-thumb");
            }

            thumbnails.forEach((thumb) => {
                thumb.addEventListener("click", function() {

                    // Set main image
                    mainImage.src = this.src;

                    // Remove active class
                    thumbnails.forEach(t => t.classList.remove("active-thumb"));

                    // Add active class to clicked thumbnail
                    this.classList.add("active-thumb");
                });
            });

        });
    </script>

@endsection
