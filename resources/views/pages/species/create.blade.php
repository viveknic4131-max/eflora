<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="species"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Species"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12">
                    {{-- @include('components.alerts.alerts.success')
                    @include('components.alerts.alerts.errors') --}}
                    @if (session('status'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                                    <span class="text-sm">{{ session('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible text-white mt-3" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-sm">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div
                                class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Species</h6>
                                <a class="btn bg-gradient-dark mb-0 me-3" href="{{ route('species.index') }}">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back to list
                                </a>
                            </div>
                        </div>


                        <div class="card-body px-5 pb-4">
                            <form action="{{ route('species.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- Searchable Family --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            {{-- <label for="family_id" class="ms-0">Select Family *</label> --}}
                                            <select name="family_id" id="family_id" class="form-control"
                                                required></select>
                                        </div>
                                        @error('family_id')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <select name="genus_id" id="genus_id" class="form-control"
                                                disabled></select>
                                        </div>
                                        @error('genus_id')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    {{-- Searchable Multiple Volumes --}}
                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="genus" class="form-control"
                                                placeholder="Enter Species Name *" required>
                                        </div>
                                        @error('genus')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="description" class="form-control"
                                                placeholder="Enter Species Description *" required>
                                        </div>
                                        @error('description')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="author" class="form-control"
                                                placeholder="Enter Author*" required>
                                        </div>
                                        @error('author')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="publication" class="form-control"
                                                placeholder="Enter Publication*" required>
                                        </div>
                                        @error('publication')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="year_described" class="form-control"
                                                placeholder="Enter Year Publication*" required>
                                        </div>
                                        @error('year_described')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="volume" class="form-control"
                                                placeholder="Enter Volume*" required>
                                        </div>
                                        @error('volume')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="page" class="form-control"
                                                placeholder="Enter Page No.*" required>
                                        </div>
                                        @error('page')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="common_name" class="form-control"
                                                placeholder="Enter Common Name" required>
                                        </div>
                                        @error('common_name')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>



                                    {{-- <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="synonyms" class="form-control"
                                                placeholder="Enter Synonyms" required>
                                        </div>
                                        @error('synonyms')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="col-md-6 mb-3">
                                        <label class="form-label">Synonyms</label>

                                        <div id="synonyms_wrapper">
                                            <div class="input-group mb-2 synonym-item">
                                                <input type="text" name="synonyms[]" class="form-control"
                                                    placeholder="Enter Synonym" required>
                                                <button type="button"
                                                    class="btn btn-danger remove-synonym">X</button>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary" id="add_synonym">+ Add
                                            More</button>

                                        @error('synonyms')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div> --}}

                                    <div class="col-md-6 mb-3">
    <label class="form-label">Synonyms</label>

    <!-- Scrollable box (fixed height) -->
    <div id="synonyms_box"
        class="border rounded p-2 bg-white"
        style="height: 150px; overflow-y: auto; overflow-x: hidden;">

        <div id="synonyms_wrapper">
            <div class="input-group mb-2 synonym-item">
                <input type="text" name="synonyms[]" class="form-control"
                    placeholder="Enter Synonym" required>
                <button type="button" class="btn btn-danger remove-synonym">X</button>
            </div>
        </div>

    </div>

    <button type="button" class="btn btn-primary mt-2" id="add_synonym">+ Add More</button>

    @error('synonyms')
        <p class="text-danger inputerror mt-1">{{ $message }}</p>
    @enderror
</div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Upload Images</label>

                                        <input type="file" name="images[]" id="images" class="form-control"
                                            multiple accept="image/*">

                                        <div id="image_preview" class="mt-3 d-flex flex-wrap gap-3"></div>

                                        @error('images')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>


                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn bg-gradient-primary mb-0">Save
                                        Species</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>


            <x-footers.auth></x-footers.auth>
        </div>
    </main>

    <x-plugins></x-plugins>
</x-layout>
<script>
    $(document).ready(function() {
        // Family dropdown
        $('#family_id').select2({
            placeholder: 'Search Family...',
            ajax: {
                url: '{{ route('ajax.families') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        // Volumes dropdown (multi-select)
        $('#volumes').select2({
            placeholder: 'Search and select Volumes...',
            multiple: true,
            ajax: {
                url: '{{ route('ajax.volumes') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });
    });



    // GENUS dropdown dependent on FAMILY
    $('#genus_id').select2({
        placeholder: 'Select Genus...',
        allowClear: true
    });

    // When family changes → load genera
    $('#family_id').on('change', function() {
        let familyId = $(this).val();

        if (!familyId) {
            $('#genus_id').prop('disabled', true).empty();
            return;
        }

        // Fetch genus list via AJAX
        $.ajax({
            url: '{{ route('ajax.genus.by.family') }}',
            data: {
                family_id: familyId
            },
            success: function(data) {
                $('#genus_id').empty();

                data.forEach(function(item) {
                    let option = new Option(item.name, item.id, false, false);
                    $('#genus_id').append(option);
                });

                $('#genus_id').prop('disabled', false);
            }
        });
    });


    $(document).ready(function() {
// Add new synonym
$('#add_synonym').click(function () {
    $('#synonyms_wrapper').append(`
        <div class="input-group mb-2 synonym-item">
            <input type="text" name="synonyms[]" class="form-control" placeholder="Enter Synonym" required>
            <button type="button" class="btn btn-danger remove-synonym">X</button>
        </div>
    `);
});

// Remove synonym
$(document).on('click', '.remove-synonym', function () {
    $(this).closest('.synonym-item').remove();
});


    });



    // Multiple Image Preview + Remove
$('#images').on('change', function(event) {
    $('#image_preview').empty(); // Clear old previews

    let files = event.target.files;

    Array.from(files).forEach((file, index) => {
        let reader = new FileReader();

        reader.onload = function(e) {
            $('#image_preview').append(`
                <div class="image-box position-relative" style="width:120px; height:120px;">
                    <img src="${e.target.result}"
                         class="rounded shadow"
                         style="width:100%; height:100%; object-fit:cover;">

                    <button type="button"
                            class="btn btn-danger btn-sm remove-image"
                            style="position:absolute; top:5px; right:5px;"
                            data-index="${index}">
                        X
                    </button>
                </div>
            `);
        };

        reader.readAsDataURL(file);
    });
});

// Remove image from preview + input
$(document).on('click', '.remove-image', function() {
    let index = $(this).data('index');
    let fileInput = $('#images')[0];

    // Convert FileList to array
    let filesArray = Array.from(fileInput.files);

    filesArray.splice(index, 1); // Remove image at index

    // Rebuild FileList
    const dataTransfer = new DataTransfer();
    filesArray.forEach(file => dataTransfer.items.add(file));

    fileInput.files = dataTransfer.files;

    // Re-render preview
    $('#image_preview').empty();
    Array.from(fileInput.files).forEach((file, index) => {
        let reader = new FileReader();

        reader.onload = function(e) {
            $('#image_preview').append(`
                <div class="image-box position-relative" style="width:120px; height:120px;">
                    <img src="${e.target.result}"
                         class="rounded shadow"
                         style="width:100%; height:100%; object-fit:cover;">

                    <button type="button"
                            class="btn btn-danger btn-sm remove-image"
                            style="position:absolute; top:5px; right:5px;"
                            data-index="${index}">
                        X
                    </button>
                </div>
            `);
        };

        reader.readAsDataURL(file);
    });
});

</script>
