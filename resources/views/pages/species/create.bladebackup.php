<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="species"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Species"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12">

                    {{-- Alerts --}}
                    @if (session('status'))
                        <div class="alert alert-success text-white">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger text-white">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                            <form id="speciesForm"
                                action="{{ isset($species) ? route('species.update', $species->id) : route('species.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($species))
                                    @method('PUT')
                                @endif

                                <div class="row g-3">

                                    {{-- Family --}}
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

                                    {{-- Genus --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <select name="genus_id" id="genus_id" class="form-control"
                                                disabled></select>
                                        </div>
                                        @error('genus_id')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Species Name --}}
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static">
                                            <input type="text" name="species" class="form-control"
                                                placeholder="Species Name *" required>
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static">
                                            <input type="text" name="description" class="form-control"
                                                placeholder="Description *" required>
                                        </div>
                                    </div>

                                    {{-- Common Name --}}
                                    {{-- <div class="col-md-6">
                                        <input type="text" name="common_name" class="form-control"
                                            placeholder="Common Name">
                                    </div> --}}

                                    {{-- ================= AUTHORS ================= --}}
                                    <div class="col-12">
                                        <label class="fw-bold">Authors & Publications</label>

                                        <div id="authors_wrapper">

                                        </div>

                                        <button type="button" id="add_author" class="btn btn-primary btn-sm">
                                            + Add Author
                                        </button>
                                    </div>

                                    {{-- Images --}}
                                    <div class="col-12">
                                        <label>Upload Images</label>
                                        <input type="file" name="images[]" class="form-control" multiple
                                            accept="image/*">
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12 text-center">
                                        <button type="submit" id="submitBtn" class="btn bg-gradient-primary">
                                            Save Species
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <x-footers.auth />
        </div>
    </main>
</x-layout>
<script>
    $(document).ready(function() {

        // Family select2
        $('#family_id').select2({
            placeholder: 'Search Family...',
            ajax: {
                url: '{{ route('ajax.families') }}',
                dataType: 'json',
                delay: 250,
                data: params => ({
                    q: params.term
                }),
                processResults: data => ({
                    results: data.map(i => ({
                        id: i.id,
                        text: i.name
                    }))
                })
            }
        });
        $('#genus_id').select2({
            placeholder: 'Select Genus...',
            allowClear: true
        });
        // Genus load
        $('#family_id').on('change', function() {
            let familyId = $(this).val();
            $('#genus_id').prop('disabled', true).empty();

            if (!familyId) return;

            $.get('{{ route('ajax.genus.by.family') }}', {
                family_id: familyId
            }, function(data) {
                data.forEach(item => {
                    $('#genus_id').append(new Option(item.name, item.id));
                });
                $('#genus_id').prop('disabled', false);
            });
        });

        // Add Author
        let index = 0;
        $('#add_author').click(function() {
            $('#authors_wrapper').append(`
            <div class="author-item border rounded p-3 mb-3">
                <div class="row g-2">
                    <div class="col-md-4">
                            <div class="input-group input-group-static">
                        <input type="text" name="authors[${index}][name]" class="form-control" placeholder="Author Name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="input-group input-group-static">
                        <input type="text" name="authors[${index}][publication]" class="form-control" placeholder="Publication" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div class="input-group input-group-static">
                        <input type="text" name="authors[${index}][volume]" class="form-control" placeholder="Volume">
                        </div>
                    </div>
                    <div class="col-md-1">
                            <div class="input-group input-group-static">
                        <input type="number" name="authors[${index}][page]" class="form-control" placeholder="Page">
                        </div>
                    </div>
                    <div class="col-md-1">
                            <div class="input-group input-group-static">
                        <input type="year" name="authors[${index}][year]" class="form-control" placeholder="Year">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-author">Remove</button>
            </div>
        `);
            index++;
        });

        // Remove Author
        $(document).on('click', '.remove-author', function() {
            $(this).closest('.author-item').remove();
        });

        // Disable submit on click
        $('#speciesForm').submit(function() {
            $('#submitBtn').prop('disabled', true).text('Please wait...');
        });

    });
</script>
