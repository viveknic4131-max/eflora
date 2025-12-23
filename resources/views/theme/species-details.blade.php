@extends('theme.layouts.app')

@section('title', $species->name . ' | E-Flora')

@section('content')


    <!-- 🌿 Header Section -->
    <section class="d-flex align-items-center text-white position-relative"
        style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container position-relative text-center py-5">
            <h1 class="display-5 fw-bold text-white">{{ $species->name }}</h1>
            {{-- <p class="lead fst-italic">{{ $species->common_name ?? 'No common name available.' }}</p> --}}
        </div>
    </section>

    <!-- 🌱 Species Details -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4 align-items-start">

                <!-- 🖼️ Image + Thumbnails -->
                <div class="col-md-5">
                    <div class="species-card p-2">

                        @php
                            $images = $species->images->pluck('pic')->toArray();
                            $main = !empty($images) ? asset($images[0]) : asset('images/as.jpg');
                        @endphp

                        <!-- Main Image -->
                        <img id="mainImage" src="{{ $main }}" class="img-fluid rounded main-img mb-3"
                            alt="{{ $species->name }}">

                        <!-- Thumbnails -->
                        {{-- <div id="thumbnails" class="d-flex flex-wrap gap-2 justify-content-center">
                            @foreach ($images as $img)
                                @if (file_exists(public_path('storage/plants/' . $img)))
                                    <img src="{{ asset('storage/plants/' . $img) }}" class="thumb-img"
                                        style="width:70px; height:70px; object-fit:cover; cursor:pointer; border-radius:6px; border:2px solid #eee;">
                                @endif
                            @endforeach
                        </div> --}}



                        @if (count($images) > 0)
                            <div class="position-relative">

                                <button class="btn btn-light position-absolute start-0 top-50 translate-middle-y"
                                    onclick="slideThumbs(-150)">‹</button>

                                <div id="thumbnails" class="d-flex gap-2"
                                    style="overflow-x:auto; white-space:nowrap; padding:5px 40px;">
                                    @foreach ($images as $img)
                                        <img src="{{ $img }}" style="width:70px; height:70px;">
                                    @endforeach
                                </div>

                                <button class="btn btn-light position-absolute end-0 top-50 translate-middle-y"
                                    onclick="slideThumbs(150)">›</button>

                            </div>
                        @endif




                    </div>
                </div>

                <div class="col-md-7">
                    <div class="species-card p-4">
                        <h4 class="fw-bold text-success mb-3">About</h4>
                        @php
                            // dd($species);

                            $parts = [];

                            $parts[] = '<strong>' . strtoupper($species->genus->name) . '</strong>';
                            $parts[] = '<strong>' . '<i>' . $species->name . '</i>' . '</strong>';

                            if ($species->author) {
                                $parts[] = $species->author . ',';
                            }

                            if ($species->is_infra === true) {
                                $infra_value = $species->infra_values;

                                $infra = json_decode($infra_value, true);
                                $infra['rank'];
                                $infra['taxon_name'];

                                $species_name = $infra['rank'] . ' ' . $infra['taxon_name'];
                                $parts[] = $species_name . ',';
                            }

                            if ($species->is_in === true) {
                                $infra_value = $species->in_author;

                                $infra = json_decode($infra_value, true);
                                // dd($infra);
                                $infra['in_author_1'];
                                $infra['in_author_2'];

                                $species_is_in =
                                    $infra['in_author_1'] . ' ' . '<i>in</i>' . ' ' . $infra['in_author_2'];

                                $parts[] = $species_is_in . ',';
                            }

                            if ($species->publication) {
                                $parts[] = $species->publication;
                            }

                            if ($species->volume || $species->page) {
                                $parts[] = '<i>' . trim($species->volume . '</i>' . ' : ' . $species->page) . '.';
                            }

                            if ($species->year_described) {
                                $parts[] = $species->year_described . '.';
                            }

                        @endphp

                        @php
                            $synonymLines = [];

                            // Eager loading is assumed: Species::with('genus','synonyms')->find($id)

                            foreach ($species->synonyms()->get() as $synonym) {
                                $line = [];

                                // Genus (constant for all synonyms)
                                $line[] = '<strong>' . strtoupper($species->genus->name) . '</strong>';

                                // Species epithet
                                if ($synonym->spcies) {
                                    $line[] = '<strong>' . '<i>' . e($synonym->spcies) . '</i>' . '</strong>';
                                }

                                // Author
                                if ($synonym->author) {
                                    $line[] = e($synonym->author) . ',';
                                }

                                if ($synonym->is_infra === true) {
                                $infra_value = $synonym->infra_values;

                                $infra = json_decode($infra_value, true);
                                $infra['rank'];
                                $infra['taxon_name'];

                                $species_name = $infra['rank'] . ' ' . $infra['taxon_name'];
                                $line[] = $species_name . ',';
                            }

                            if ($synonym->is_in === true) {
                                $infra_value = $synonym->in_author;

                                $infra = json_decode($infra_value, true);
                                // dd($infra);
                                $infra['in_author_1'];
                                $infra['in_author_2'];

                                $species_is_in =
                                    $infra['in_author_1'] . ' ' . '<i>in</i>' . ' ' . $infra['in_author_2'];

                                $line[] = $species_is_in . ',';
                            }

                                // Publication
                                if ($synonym->publication) {
                                    $line[] = e($synonym->publication);
                                }

                                // Volume : Page
                                if ($synonym->volume || $synonym->page) {
                                    $line[] =
                                        '<i>' . trim(e($synonym->volume) . '</i>' . ' : ' . e($synonym->page)) . '.';
                                }

                                // Year
                                if ($synonym->year_described) {
                                    $line[] = e($synonym->year_described) . '.';
                                }

                                $synonymLines[] = implode(' ', $line);
                            }
                        @endphp



                        <p class="text-muted" style="text-align: justify;">
                            {!! implode(' ', $parts) !!}
                        </p>
                        <p class="text-muted" style="text-align: justify; line-height: 1.6;">
                            {!! implode('<br>', $synonymLines) !!}
                        </p>
                    </div>
                </div>

            </div>

            <!-- 📖 Description -->
            {{-- <div class="species-card mt-5 p-4">
                <h4 class="fw-bold text-success mb-3">About</h4>
                @php

                    $parts = [];

                    $parts[] = strtoupper($species->genus->name);
                    $parts[] = '<i>' . $species->name . '</i>';

                    if ($species->author) {
                        $parts[] = $species->author . ',';
                    }

                    if ($species->publication) {
                        $parts[] = $species->publication;
                    }

                    if ($species->volume || $species->page) {
                        $parts[] = trim($species->volume . ': ' . $species->page) . '.';
                    }

                    if ($species->year_described) {
                        $parts[] = $species->year_described . '.';
                    }

                    $dist = [];
                    if (count($species->distributions) > 0 && !empty($species->distributions)) {
                        $dist[] = implode(', ', $species->distributions->toArray()) . '.';
                    }
                @endphp

                @php
                    $synonymLines = [];

                    // Eager loading is assumed: Species::with('genus','synonyms')->find($id)

                    foreach ($species->synonyms()->get() as $synonym) {
                        $line = [];

                        // Genus (constant for all synonyms)
                        $line[] = strtoupper($species->genus->name);

                        // Species epithet
                        if ($synonym->spcies) {
                            $line[] = '<i>' . e($synonym->spcies) . '</i>';
                        }

                        // Author
                        if ($synonym->author) {
                            $line[] = e($synonym->author) . ',';
                        }

                        // Publication
                        if ($synonym->publication) {
                            $line[] = e($synonym->publication);
                        }

                        // Volume : Page
                        if ($synonym->volume || $synonym->page) {
                            $line[] = trim(e($synonym->volume) . ': ' . e($synonym->page)) . '.';
                        }

                        // Year
                        if ($synonym->year_described) {
                            $line[] = e($synonym->year_described) . '.';
                        }

                        $synonymLines[] = implode(' ', $line);
                    }

                    //  states

                @endphp



                <p class="text-muted" style="text-align: justify;">
                    {!! implode(' ', $parts) !!}
                </p>
                <p class="text-muted" style="text-align: justify; line-height: 1.6;">
                    {!! implode('<br>', $synonymLines) !!}
                </p>


            </div> --}}

            <div class="species-card mt-5 p-4">
                <h4 class="fw-bold text-success mb-3">Distribution</h4>
                @php

                    $dist = [];
                    if (count($species->distributions) > 0 && !empty($species->distributions)) {
                        $dist[] = implode(', ', $species->distributions->toArray()) . '.';
                    }
                @endphp






                <p class="text-muted" style="text-align: justify; line-height: 1.6;">
                    {!! implode('<br>', $dist) !!}
                </p>


            </div>

            <!-- 🌼 Synonyms -->


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
    <script>
        function slideThumbs(amount) {
            document.getElementById('thumbnails').scrollBy({
                left: amount,
                behavior: 'smooth'
            });
        }
    </script>
@endsection
