<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="volume"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Volume"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                @if (@session('success'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                                <span class="text-sm">{{ session('success') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>


                    @endsession
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
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">

                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mt-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Volume</h6>
                            </div>
                        </div>

                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('volume.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                Volume</a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                S.NO.
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                Volume</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                Volume Name</th>
                                            {{-- <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                Descriptions</th> --}}
                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                Volume Type</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                                CREATION DATE
                                            </th>
                                             <th
                                                class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger">
                                            ACTIONS
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($families as $index => $permission)
                                            <tr>
                                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder">


                                                    <h6 class="mb-0 text-sm text-center">
                                                        {{ $families->firstItem() + $index }}</h6>


                                                </td>
                                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    <h6 class="mb-0 text-sm text-center">{{ $permission->volume }}</h6>

                                                </td>

                                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    <h6 class="mb-0 text-sm text-center">{{ $permission->name }}</h6>

                                                </td>
                                                {{-- <td class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    <h6 class="mb-0 text-sm text-center">{{ $permission->description }}
                                                    </h6>


                                                </td> --}}

                                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    <h6 class="mb-0 text-sm text-center">
                                                        {{ $permission->type == 0 ? 'BSI' : 'Flora of India' }}
                                                    </h6>
                                                </td>
                                                <td class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                    <h6 class="mb-0 text-sm text-center">
                                                        {{ $permission->created_at->format('d-M-Y') }}</h6>

                                                </td>
                                                <td class="align-middle text-center">
                                                    <a class="btn btn-success btn-link"><i
                                                            class="material-icons">edit</i></a>
                                                    <button type="button" class="btn btn-danger btn-link"><i
                                                            class="material-icons">close</i></button>
                                                </td>

                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-xs font-weight-bold">No
                                                    records found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>



                            </div>

                        </div>
 <div class="card-footer d-flex justify-content-between align-items-center">
                                <!-- Rows per page selector -->


                                <!-- Pagination links -->
                                <div>
                                    {{ $families->links('vendor.pagination.bootstrap-5') }}
                                </div>
                                <div class="d-flex align-items-center">
                                    {{-- <label for="perPage" class="me-2 mb-0">Rows per page:</label><br> --}}
                                    <select id="perPage" class="form-select form-select-sm"
                                        onchange="changePerPage(this)">

                                        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5
                                        </option>
                                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10

                                        <option value="40" {{ request('perPage') == 40 ? 'selected' : '' }}>40
                                        </option>
                                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50
                                        </option>
                                    </select>
                                </div>
                            </div>
                    </div>


                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
