<style>
    .permission-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 6px 10px;
        transition: background 0.2s ease;
    }

    .permission-item:hover {
        background: #eef2ff;
    }

    .check-icon {
        transition: opacity 0.2s ease;
    }

    .card h6 {
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    .form-check-label {
        font-size: 0.85rem;
        color: #333;
    }
</style>

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
                                    <div class="col-12 mb-4">
                                        <h6 class="mb-3 fw-bold">Assign Permissions</h6>

                                        <div class="row">
                                            @foreach ($permissions as $module => $perms)
                                                <div class="col-md-3 mb-4">
                                                    <div class="card border shadow-sm p-3">
                                                        {{-- <h6
                                                            class="text-uppercase text-primary fw-bold mb-3 border-bottom pb-2">
                                                            {{ $module }}</h6> --}}

                                                        @foreach ($perms as $perm)
                                                            <div
                                                                class="form-check d-flex align-items-center justify-content-between mb-2 permission-item">
                                                                <div>
                                                                    <input
                                                                        class="form-check-input permission-checkbox me-2"
                                                                        type="checkbox" name="permissions[]"
                                                                        value="{{ $perm->name }}"
                                                                        id="perm_{{ $perm->id }}">
                                                                    <label class="form-check-label text-sm"
                                                                        for="perm_{{ $perm->id }}">
                                                                        {{ $perm->name }}
                                                                    </label>
                                                                </div>
                                                                <i class="material-icons text-success check-icon"
                                                                    style="display:none; font-size:18px;">check_circle</i>
                                                            </div>
                                                        @endforeach
                                                    </div>
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

<script>
    document.querySelectorAll('.permission-checkbox').forEach(chk => {
        chk.addEventListener('change', function() {
            const icon = this.closest('.permission-item').querySelector('.check-icon');
            icon.style.display = this.checked ? 'inline' : 'none';
        });
    });
</script>
