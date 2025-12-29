<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="news"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create News & Updates"></x-navbars.navs.auth>

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
                                <h6 class="text-white text-capitalize ps-3 mb-0">News & Updates Form</h6>
                                <a class="btn bg-gradient-dark mb-0 me-3" href="{{ route('news.index') }}">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back to list
                                </a>
                            </div>
                        </div>

                        <div class="card-body px-5 pb-4">
                            <form id="familyForm"
                                action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf
                                @if (isset($news))
                                    @method('PUT')
                                @endif
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Enter Title *" required
                                                value="{{ old('title', $news->title ?? '') }}">
                                        </div>
                                        @error('title')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <input type="file" name="file_path" class="form-control"
                                                placeholder="Upload File *" {{ isset($news) ? '' : 'required' }}>
                                            @if (isset($news) && $news->file_path)
                                                <div class="mt-2">
                                                    <small class="text-muted">Click to View file:</small><br>

                                                    {{-- If image --}}
                                                    {{-- <img src="{{ asset($news->file_path) }}" alt="News File"
                                                        style="max-height: 80px;"> --}}

                                                    {{-- OR if not image --}}
                                                    <a href="{{ asset($news->file_path) }}" target="_blank">
                                                        View File
                                                    </a>
                                                </div>
                                            @endif

                                        </div>
                                        @error('file_path')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" id="submitBtn" class="btn bg-gradient-primary mb-0">
                                            {{ isset($family) ? 'Update Family' : 'Save Family' }}
                                        </button>
                                    </div>
                                    {{-- <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn bg-gradient-primary mb-0">Save
                                            Family</button>
                                    </div> --}}
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
    document.getElementById("familyForm").addEventListener("submit", function() {
        const btn = document.getElementById("submitBtn");
        btn.disabled = true;
        btn.innerHTML = "Please wait...";
    });
</script>
