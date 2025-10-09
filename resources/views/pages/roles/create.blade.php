<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="roles"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Create role"></x-navbars.navs.auth>

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
                                <h6 class="text-white text-capitalize ps-3 mb-0">role Form</h6>
                                <a class="btn bg-gradient-dark mb-0 me-3" href="{{ route('roles.index') }}">
                                    <i class="material-icons text-sm">arrow_back</i>&nbsp;&nbsp;Back to list
                                </a>
                            </div>
                        </div>

                        <div class="card-body px-5 pb-4">
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter role Name *" required>
                                        </div>
                                        @error('name')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="input-group input-group-static">
                                            <select name="guard" class="form-control" required>
                                                <option value="">Select Guard *</option>
                                                <option value="web">WEB</option>
                                                <option value="api">API</option>
                                            </select>
                                        </div>
                                        @error('guard')
                                            <p class="text-danger inputerror mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6 class="mb-3">Assign Permissions</h6>
                                        <div class="row">
                                            @foreach ($permissions as $module => $perms)
                                                <div class="col-md-2">
                                                    {{-- <h6 class="text-uppercase">{{ $module }}</h6> --}}
                                                    @foreach ($perms as $perm)
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input"
                                                                type="checkbox" name="permissions[]"
                                                                value="{{ $perm->name }}"
                                                                id="perm_{{ $perm->id }}"><br>{{ $module }}
                                                            {{-- <label class="custom-control-label"
                                                                for="perm_{{ $perm->id }}">{{ $perm->name }}</label> --}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn bg-gradient-primary mb-0">Save
                                            role</button>
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
