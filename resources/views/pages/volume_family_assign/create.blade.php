<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="assign_volume"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Assign Valume To Family"></x-navbars.navs.auth>

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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Assign Volumes to Family</h6>
                                <a class="btn bg-gradient-dark mb-0 me-3" href="{{ route('assign-volume-family') }}">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back to list
                                </a>
                            </div>
                        </div>


                            <div class="card-body px-5 pb-4">
                                <form action="{{ route('store-volume-family') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        {{-- Searchable Family --}}
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group input-group-static">
                                                <label for="family_id" class="ms-0">Select Family *</label>
                                                <select name="family_id" id="family_id" class="form-control"
                                                    required></select>
                                            </div>
                                            @error('family_id')
                                                <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Searchable Multiple Volumes --}}
                                        <div class="col-md-6 mb-3">
                                            <div class="input-group input-group-static">
                                                <label for="volumes" class="ms-0">Select Volumes *</label>
                                                <select name="volumes[]" id="volumes" class="form-control" multiple
                                                    required></select>
                                            </div>
                                            @error('volumes')
                                                <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn bg-gradient-primary mb-0">Assign
                                            Volumes</button>
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
