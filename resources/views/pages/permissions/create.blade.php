<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="taxon"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Taxon"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div
                                class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3">Taxon Form</h6>
                                <div class=" me-3 my-3 text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="{{ route('taxon.index') }}"><i
                                            class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back to list</a>
                                </div>
                            </div>
                        </div>


                        <div class="card-body px-0 pb-2 px-5">
                            <form action="{{ route('taxon.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">           <label class="form-label">Select Taxon Type *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="taxon_type_id" class="form-control" required>
                                                <option value="">-- Select Taxon Type --</option>
                                                @foreach ($taxonTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('taxon_type_id')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- ii. Select Parent Taxon -->
                                    <div class="col-md-6">
                                        <label class="form-label">Select Parent Taxon *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="parent_taxon_id" class="form-control" required>
                                                <option value="">-- Select Parent Taxon --</option>
                                                @foreach ($parentTaxa as $parent)
                                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('parent_taxon_id')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- iii. Taxon Name -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Taxon Name *</label>
                                            <input type="text" name="taxon_name" class="form-control" required>
                                        </div>
                                        @error('taxon_name')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- iv. Taxon Volume -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Taxon Volume *</label>
                                            <input type="text" name="taxon_volume" class="form-control" required>
                                        </div>
                                        @error('taxon_volume')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- v. Citation Separator -->
                                    <div class="col-md-6">

                                        <label class="form-label">Citation Separator *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="citation_separator" class="form-control" required>
                                                <option value="">-- Select Format --</option>
                                                <option value="default">Default Format</option>
                                                <option value="comma">Comma Separated</option>
                                            </select>
                                        </div>
                                        @error('citation_separator')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- vi. Taxon Citation -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Taxon Citation *</label>
                                            <input type="text" name="taxon_citation" class="form-control" required>
                                        </div>
                                        @error('taxon_citation')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- vii. Journal Author Name -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Journal Author Name</label>
                                            <input type="text" name="journal_author_name" class="form-control">
                                        </div>
                                        @error('journal_author_name')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- viii. Taxon Distribution -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Taxon Distribution</label>
                                            <input type="text" name="taxon_distribution" class="form-control">
                                        </div>
                                        @error('taxon_distribution')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- ix. Key Heading -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Key Heading</label>
                                            <input type="text" name="key_heading" class="form-control">
                                        </div>
                                        @error('key_heading')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- x. Synonym Title -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Synonym Title</label>
                                            <input type="text" name="synonym_title" class="form-control">
                                        </div>
                                        @error('synonym_title')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- xi. Taxon Synonym -->
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Taxon Synonym</label>
                                            <input type="text" name="taxon_synonym" class="form-control">
                                        </div>
                                        @error('taxon_synonym')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- xii–xv. Boolean Fields -->
                                    @php
                                        $yesNoOptions = ['yes' => 'Yes', 'no' => 'No'];
                                    @endphp

                                    <div class="col-md-3">  <label class="form-label">Is Excluded Taxon *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="is_excluded_taxon" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                @foreach ($yesNoOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">     <label class="form-label">Is Cultivated Taxon *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="is_cultivated_taxon" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                @foreach ($yesNoOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">    <label class="form-label">Is Introduced Taxon *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="is_introduced_taxon" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                @foreach ($yesNoOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">  <label class="form-label">Is Doubtful Taxon *</label>
                                        <div class="input-group input-group-outline my-3">

                                            <select name="is_doubtful_taxon" class="form-control" required>
                                                <option value="">-- Select --</option>
                                                @foreach ($yesNoOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Save Taxon</button>
                                    </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".input-group-outline select").forEach(function(select) {
            // Add/Remove 'is-focused' only when user selects a value
            select.addEventListener("change", function() {
                if (this.value) {
                    this.parentElement.classList.add("is-focused");
                    this.parentElement.classList.add("is-filled");
                } else {
                    this.parentElement.classList.remove("is-focused");
                    this.parentElement.classList.remove("is-filled");
                }
            });

            // Handle page load (for pre-filled dropdowns)
            if (select.value) {
                select.parentElement.classList.add("is-focused");
                select.parentElement.classList.add("is-filled");
            }
        });
    });
</script>
