<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="species"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Species"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12">
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
                            <form
                                action="{{ isset($species) ? route('species.update', $species->id) : route('species.store') }}"
                                id="speciesForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($species))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    {{-- Searchable Family --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <label for="family_id" class="ms-0">Select Family
                                                *</label>
                                            <select name="family_id" id="family_id" class="form-control"
                                                required></select>
                                        </div>
                                        @error('family_id')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <label for="genus_id" class="ms-0">Select Genus
                                                *</label>
                                            <select name="genus_id" id="genus_id" class="form-control"
                                                disabled></select>
                                        </div>
                                        @error('genus_id')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <div class="input-group input-group-static">

                                            <input type="name" name="species" class="form-control"
                                                placeholder="Enter Species Name *" required>
                                        </div>
                                        @error('species')
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
                                            <label for="states" class="ms-0">For Distribution Select States
                                                *</label>
                                            <select name="states[]" id="states" class="form-control" multiple
                                                required></select>
                                        </div>
                                        @error('states')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="row form-check">
                                        <input type="checkbox"
                                            class="form-check-input species_infraspecific-check">Infraspecific

                                    </div>

                                    <div class="row mt-2 infraspecific-fields d-none">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-static">
                                                <input type="text" name="rank"
                                                    class="form-control infraspecific-input" placeholder="Rank">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group input-group-static">
                                                <input type="text" name="taxon_name"
                                                    class="form-control infraspecific-input" placeholder="Taxon Name">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row form-check">
                                        <input type="checkbox"
                                            class="form-check-input species_in-check form-check-label">In

                                    </div>

                                    <div class="row  mt-2 in-fields d-none">


                                        <div class="col-md-3">
                                            <div class="input-group input-group-static">
                                                <input type="text" name="in_author_1"
                                                    class="form-control in-input" placeholder="In Author 1">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-3">
                                            <div class="input-group input-group-static">
                                                <input type="text" name="in_author_2"
                                                    class="form-control in-input" placeholder="In Author 2">
                                            </div>
                                        </div> --}}

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

                                    <button type="submit" id="submitBtn" class="btn bg-gradient-primary mb-0">
                                        {{ isset($species) ? 'Update Species' : 'Save Species' }}
                                    </button>
                                </div>
                            </form>

                            <form id="synonymsForm" class="mt-5">
                                @csrf

                                <input type="hidden" name="species_id"
                                    value="{{ isset($species) ? $species->id : '' }}">
                                <div class="col-12">
                                    <label class="fw-bold">Synonyms</label>

                                    <div id="authors_wrapper">

                                    </div>

                                    <button type="button" id="add_author" class="btn btn-primary btn-sm">
                                        + Add Synonyms
                                    </button>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    {{-- <button type="button" id="previewBtn" class="btn bg-gradient-info me-2">
                                        Preview
                                    </button> --}}
                                    <button type="submit" id="synonymssubmitBtn"
                                        class="btn bg-gradient-primary mb-0">
                                        Save Synonyms
                                    </button>
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


    {{-- model --}}
    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title">Species Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="previewContent">
                    <!-- Preview HTML -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Edit
                    </button>
                    <button type="button" id="confirmSubmit" class="btn btn-success">
                        Confirm & Submit
                    </button>
                </div>

            </div>
        </div>
    </div>

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


    // $(document).ready(function() {
    //     // Add new synonym
    //     $('#add_synonym').click(function() {
    //         $('#synonyms_wrapper').append(`
    //     <div class="input-group mb-2 synonym-item">
    //         <input type="text" name="synonyms[]" class="form-control" placeholder="Enter Synonym" required>
    //         <button type="button" class="btn btn-danger remove-synonym">X</button>
    //     </div>
    // `);
    //     });

    //     // Remove synonym
    //     $(document).on('click', '.remove-synonym', function() {
    //         $(this).closest('.synonym-item').remove();
    //     });


    // });



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
{{-- //  for authors --}}



<script>
    $(document).ready(function() {

        let index = 0;

        $('#add_author').click(function() {

            let genusData = $('#genus_id').select2('data');

            if (!genusData || genusData.length === 0) {
                alert('Please select a genus first.');
                return;
            }
            let genusName = $('#genus_id').select2('data')[0].text;

            let lastAuthor = $('#authors_wrapper .author-item').last();

            if (lastAuthor.length) {
                let isValid = true;

                lastAuthor.find('input[required]').each(function() {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    alert('Please fill all required fields before adding another author.');
                    return;
                }
            }

            $('#authors_wrapper').append(`
          <div class="author-item border rounded p-3 mb-3">

                <div class="row g-2">
                    <div class="col-md-2">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][genus]" class="form-control"
                                placeholder="Genus Name *" required value="${genusName}" oninput="updateGenus(this, ${index})">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][species]" class="form-control"
                                placeholder="Species Name *" required>
                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][name]" class="form-control"
                                placeholder="Author Name *" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][publication]" class="form-control"
                                placeholder="Publication *" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][volume]" class="form-control"
                                placeholder="Volume">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="input-group input-group-static">
                            <input type="number" name="authors[${index}][page]" class="form-control"
                                placeholder="Page">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="input-group input-group-static">
                            <input type="number" name="authors[${index}][year]" class="form-control"
                                placeholder="Year">
                        </div>
                    </div>

                </div>

                <div class="row form-check">
                    <input type="checkbox" class="form-check-input infraspecific-check">Infraspecific

                </div>

                <div class="row mt-2 infraspecific-fields d-none">
                    <div class="col-md-3">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][rank]"
                                class="form-control infraspecific-input" placeholder="Rank">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][taxon_name]"
                                class="form-control infraspecific-input" placeholder="Taxon Name">
                        </div>
                    </div>


                </div>

                <div class="row form-check">
                    <input type="checkbox" class="form-check-input in-check">In

                </div>

                <div class="row  mt-2 in-fields d-none">
                    <div class="col-md-3">
                        <div class="input-group input-group-static">
                            <input type="text" name="authors[${index}][in_author_1]" class="form-control in-input"
                                placeholder="In Author 1">
                        </div>
                    </div>


                </div>
 <button type="button" class="btn btn-danger btn-sm mt-2 remove-author">
                Remove
            </button>
            </div>

                  `);

            index++;
        });

        $(document).on('click', '.remove-author', function() {
            $(this).closest('.author-item').remove();
        });

        $(document).on('change', '.infraspecific-check', function() {
            let block = $(this).closest('.author-item');
            let fields = block.find('.infraspecific-fields');

            fields.toggleClass('d-none', !this.checked);
            fields.find('.infraspecific-input').prop('required', this.checked);
        });

        $(document).on('change', '.in-check', function() {
            let block = $(this).closest('.author-item');
            let fields = block.find('.in-fields');

            fields.toggleClass('d-none', !this.checked);
            fields.find('.in-input').prop('required', this.checked);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const infraCheck = document.querySelector('.species_infraspecific-check');
        const infraFields = document.querySelector('.infraspecific-fields');
        const infraInputs = infraFields.querySelectorAll('input');

        const inCheck = document.querySelector('.species_in-check');
        const inFields = document.querySelector('.in-fields');
        const inInputs = inFields.querySelectorAll('input');

        // Infraspecific toggle
        infraCheck.addEventListener('change', function() {
            if (this.checked) {

                infraFields.classList.remove('d-none');
                infraInputs.forEach(input => input.disabled = false); // enable fields
            } else {
                infraFields.classList.add('d-none');
                infraInputs.forEach(input => input.disabled = true); // disable fields
            }
        });

        // In toggle
        inCheck.addEventListener('change', function() {
            if (this.checked) {
                inFields.classList.remove('d-none');
                inInputs.forEach(input => input.disabled = false); // enable fields
            } else {
                inFields.classList.add('d-none');
                inInputs.forEach(input => input.disabled = true); // disable fields
            }
        });

        // Initially disable fields if checkboxes are unchecked
        if (!infraCheck.checked) {
            infraInputs.forEach(input => input.disabled = true);
        }
        if (!inCheck.checked) {
            inInputs.forEach(input => input.disabled = true);
        }
    });
</script>

<script>
    let SAVED_SPECIES_ID = null;

    $('#speciesForm').on('submit', function(e) {
        e.preventDefault();

        const btn = $('#submitBtn');
        btn.prop('disabled', true).text('Please wait...');

        // Collect form data
        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                SAVED_SPECIES_ID = res.species_id;
                $('#synonymsForm input[name="species_id"]').val(SAVED_SPECIES_ID);

                $('#speciesForm')
                    .find('input, select, textarea')
                    .prop('disabled', true);

                btn.text('Saved');

                alert('Species saved successfully. Now add synonyms.');


                // btn.text('Saved');
                // alert('Species & Synonyms saved successfully');
                // // Optional: disable inputs to prevent double submission
                // $('#speciesForm').find('input, select, textarea').prop('disabled', true);
            },
            error: function(xhr) {
                btn.prop('disabled', false).text('Save Species');

                if (xhr.status === 422) {
                    // validation error
                    alert('Please fill all required fields correctly.');
                } else {
                    alert('Something went wrong!');
                }
            }
        });
    });
</script>


<script>
    $('#synonymsForm').on('submit', function(e) {
        e.preventDefault();

        if (!SAVED_SPECIES_ID) {
            alert('Please save species first');
            return;
        }

        const btn = $('#submitBtn');
        btn.prop('disabled', true).text('Please wait...');

        // Collect form data
        let formData = new FormData(this);

        // Add authors/synonyms dynamically to FormData
        $('#authors_wrapper .author-item').each(function(i) {
            $(this).find('input').each(function() {
                const name = $(this).attr('name');
                formData.append(name, $(this).val());
                formData.append('_token', '{{ csrf_token() }}');
            });
        });

        $.ajax({
            url: '{{ route('species.synonyms.store') }}',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res);
                btn.text('Saved');
                alert(' Synonyms saved successfully');

                alert('Synonyms saved successfully');
                $('#synonymsForm').find('input, select, textarea').prop('disabled', true);
                // window.location.href = "{{ route('species.index') }}";
            },
            error: function(xhr) {
                  console.log(res);

                // btn.prop('disabled', false).text('Save Synonyms');

                if (xhr.status === 422) {
                    // validation error
                    alert('Please fill all required fields correctly.');
                } else {
                    alert('Something went wrong!');
                    // window.location.href = "{{ route('species.index') }}";
                }
            }
        });
    });


    $('#confirmSubmit').on('click', function() {

        if (!SAVED_SPECIES_ID) {
            alert('Please save species first');
            return;
        }

        let synonyms = [];

        $('#authors_wrapper .author-item').each(function() {
            let obj = {};
            $(this).find('input').each(function() {
                obj[$(this).attr('name')] = $(this).val();
            });
            synonyms.push(obj);
        });

        $.ajax({
            url: "{{ route('species.synonyms.store') }}",
            type: "POST",
            data: {
                species_id: SAVED_SPECIES_ID,
                synonyms: synonyms,
                _token: "{{ csrf_token() }}"
            },

            success: function() {
                $('#previewModal').modal('hide');
                alert('Species + Synonyms saved successfully');
            },

            error: function() {
                alert('Failed to save synonyms');
            }
        });
    });


    //  states list

    $('#states').select2({
        placeholder: 'Search and select States...',
        multiple: true,
        ajax: {
            url: '{{ route('state.list') }}',
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

    function updateGenus(input, index) {
        authors[index].genus = input.value; // update your JS object
        updatePreview(); // optional
    }
</script>
