<style>
    .custom-card {
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
        padding: 5px;
        border-radius: 8px;
        background: white
    }
</style>



@extends('theme.layouts.app')

@section('title', 'List | E-Flora')

@section('content')
    <!-- Banner Section -->
    <section class="d-flex align-items-center text-white position-relative"
        style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container-fluid position-relative text-center py-5">
            <h1 class="display-4 fw-bold text-white">Plants</h1>
            <p class="lead mb-0">Browse and explore plant species</p>
        </div>
    </section>

    <!-- Smart Search Filter -->
    <section class="py-4 bg-light">
        <div class="container-fluid">

        </div>
    </section>

    {{-- <section class="py-4 bg-light">
    <div class="container-fluid">
        <form action="#" method="GET" class="row g-3 align-items-end">

            <!-- Keyword Input -->
            <div class="col-12 col-sm-6 col-md-2">
                <div class="position-relative">
                    <input type="text" id="searchInput" name="keyword"
                           class="form-control search-dropdown"
                           placeholder="Enter keyword..." autocomplete="off">

                    <!-- Suggestions Dropdown -->
                    <ul id="suggestions"
                        class="list-group position-absolute w-100 shadow-sm d-none"
                        style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                    </ul>
                </div>
            </div>

            <!-- Region Dropdown -->
            <div class="col-12 col-sm-6 col-md-2">
                <select name="region" id="region" class="form-select search-dropdown">
                    <option value="">Select Region</option>
                    <option value="north">North</option>
                    <option value="south">South</option>
                    <option value="east">East</option>
                    <option value="west">West</option>
                </select>
            </div>

            <!-- Genus Dropdown -->
            <div class="col-12 col-sm-6 col-md-2">
                <select name="genus" id="genus" class="form-select search-dropdown">
                    <option value="">Select Genus</option>
                    <option value="rosa">Rosa</option>
                    <option value="lilium">Lilium</option>
                    <option value="cactus">Cactus</option>
                    <option value="orchidaceae">Orchidaceae</option>
                </select>
            </div>

            <!-- Species Dropdown -->
            <div class="col-12 col-sm-6 col-md-2">
                <select name="species" id="species" class="form-select search-dropdown">
                    <option value="">Select Family</option>
                    <option value="indica">Indica</option>
                    <option value="japonica">Japonica</option>
                    <option value="officinalis">Officinalis</option>
                    <option value="alba">Alba</option>
                </select>
            </div>

            <!-- Search Button -->
            <div class="col-12 col-sm-6 col-md-2 text-center">
                <button type="submit" class="btn btn-success cstm-serach-btn">
                    <i class="bi bi-search me-2"></i> Search
                </button>
            </div>
        </form>

        <!-- Selected Tags -->
        <div id="selectedTags" class="mt-3 d-flex flex-wrap gap-2"></div>
    </div>
</section> --}}


    <section class="py-4 bg-light">
        <div class="container-fluid">
            <form action="#" method="GET" class="row g-2 g-md-3 align-items-end justify-content-center filter-bar">

                <!-- Keyword Input -->
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="position-relative">
                        <input type="text" id="searchInput" name="keyword" class="form-control filter-input"
                            placeholder="Enter keyword..." autocomplete="off">

                        <!-- Suggestions Dropdown -->
                        <ul id="suggestions" class="list-group position-absolute w-100 shadow-sm d-none"
                            style="z-index: 1000; max-height: 200px; overflow-y: auto;">
                        </ul>
                    </div>
                </div>

                <!-- Region Dropdown -->
                <div class="col-12 col-sm-6 col-md-2">
                    <select name="region" id="region" class="form-select filter-input">
                        <option value="">Select Region</option>
                        <option value="north">North</option>
                        <option value="south">South</option>
                        <option value="east">East</option>
                        <option value="west">West</option>
                    </select>
                </div>

                <!-- Genus Dropdown -->
                <div class="col-12 col-sm-6 col-md-2">
                    <select name="genus" id="genus" class="form-select filter-input">
                        <option value="">Select Genus</option>
                        <option value="rosa">Rosa</option>
                        <option value="lilium">Lilium</option>
                        <option value="cactus">Cactus</option>
                        <option value="orchidaceae">Orchidaceae</option>
                    </select>
                </div>

                <!-- Species Dropdown -->
                <div class="col-12 col-sm-6 col-md-2">
                    <select name="species" id="species" class="form-select filter-input">
                        <option value="">Select Family</option>
                        <option value="indica">Indica</option>
                        <option value="japonica">Japonica</option>
                        <option value="officinalis">Officinalis</option>
                        <option value="alba">Alba</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div class="col-12 col-sm-6 col-md-2 text-center">
                    <button type="submit" class="btn btn-success filter-btn w-100">
                        <i class="bi bi-search me-2"></i> Search
                    </button>
                </div>
            </form>

            <!-- Selected Tags -->
            <div id="selectedTags" class="mt-3 d-flex flex-wrap gap-2"></div>
        </div>
    </section>




    <!-- Dummy Plant Cards -->
    <section class="py-3">
        <div class="container-fluid">
            <div class="row g-4">

                @if (!empty($data))

                    @foreach ($data as $plant)
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <div>
                                @if ($plant['images'] != null)
                                    <a href="#"> <img src="{{$plant['images']}}"
                                            class="card-img-top img-fluid" style="height: 220px; object-fit: cover;"
                                            alt="Plant "> </a>
                                @else
                                    <a href="#"> <img src="{{ asset('storage/images/species.jpg') }}"
                                            class="card-img-top img-fluid" style="height: 220px; object-fit: cover;"
                                            alt="Plant "> </a>
                                @endif


                                <a href="#" style="text-decoration: none;  color: #299a45;">
                                    <div class="custom-card d-flex flex-column ">
                                        <b> 🌿 {{ $plant['rank'] }}</b>

                                        <h5 class="card-title font-italic">{{ $plant['name'] . ' (' }}
                                            {{ $plant['author'] . ')' }}</h5>
                                        {{-- <p class="card-title">Nees{{ $i }}</p> --}}
                                        <p class="p">
                                            {!! $plant['snippet'] !!}
                                        </p>



                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            No plants found matching your criteria.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", () => {
        // 🌱 Dummy keyword suggestions (you can expand later or fetch from DB)
        const keywords = [
            "Rose", "Tulip", "Cactus", "Lily", "Sunflower", "Orchid", "Bamboo", "Fern", "Palm", "Mango",
            "Neem", "Banana", "Peepal", "Aloe Vera", "Jasmine", "Hibiscus", "Lavender", "Marigold",
            "Money Plant", "Lotus", "Pine", "Oak", "Maple", "Guava", "Papaya", "Chili", "Mint", "Coriander"
        ];

        const input = document.getElementById("searchInput");
        const suggestionsBox = document.getElementById("suggestions");
        const selectedTags = document.getElementById("selectedTags");

        // Show suggestions while typing
        input.addEventListener("input", function() {
            const query = this.value.toLowerCase();
            suggestionsBox.innerHTML = "";
            if (!query) {
                suggestionsBox.classList.add("d-none");
                return;
            }

            // filter keywords
            const filtered = keywords.filter(k => k.toLowerCase().includes(query));
            if (filtered.length) {
                filtered.forEach(item => {
                    const li = document.createElement("li");
                    li.className = "list-group-item list-group-item-action";
                    li.textContent = item;
                    li.onclick = () => addTag(item);
                    suggestionsBox.appendChild(li);
                });
                suggestionsBox.classList.remove("d-none");
            } else {
                suggestionsBox.classList.add("d-none");
            }
        });

        // Add tag
        function addTag(text) {
            if ([...selectedTags.children].some(tag => tag.dataset.value === text)) return;

            const tag = document.createElement("span");
            tag.className = "badge bg-success d-flex align-items-center text-white px-3 py-2";
            tag.dataset.value = text;
            tag.innerHTML = `${text} <span class="ms-2 mx-2" style="cursor:pointer;">&times;</span>`;
            tag.querySelector("span").onclick = () => tag.remove();

            selectedTags.appendChild(tag);
            input.value = "";
            suggestionsBox.classList.add("d-none");
        }

        // Hide suggestions when clicking outside
        document.addEventListener("click", (e) => {
            if (!suggestionsBox.contains(e.target) && e.target !== input) {
                suggestionsBox.classList.add("d-none");
            }
        });
    });
</script>
