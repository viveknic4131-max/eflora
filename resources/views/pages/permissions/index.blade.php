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

                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{route('taxon.create')}}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                Taxon</a>
                        </div>
                        {{-- <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                PHOTO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                TAXON NAME</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TAXON TYPE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TAXON PARENT</th>

                                                <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TAXON VOLUME</th>

                                                  <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TAXON AUTHOR</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                CREATION DATE
                                            </th>
                                              <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ACTIONS
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">1</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">John</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">john@creative-tim.com
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Admin</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">22/03/18</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">2</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-3.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user2">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Alexa</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    alexa@creative-tim.com</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Creator</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">16/06/18</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                href="" data-original-title=""
                                                title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                             <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">3</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-4.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user3">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Laurent</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    laurent@creative-tim.com</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Member</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">30/06/18</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">4</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-3.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user4">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Michael</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    michael@creative-tim.com</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Member</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">16/06/19</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">5</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user5">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Richard</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    richard@creative-tim.com</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Creator</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">16/06/18</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">6</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/team-4.jpg"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user6">
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Miriam</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    miriam@creative-tim.com</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">Creator</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">26/06/18</span>
                                            </td>
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">close</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}

                        <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PHOTO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">TAXON NAME</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAXON TYPE</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAXON PARENT</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAXON VOLUME</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAXON AUTHOR</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CREATION DATE</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACTIONS</th>
                    <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td><p class="mb-0 text-sm">1</p></td>
                    <td><img src="{{ asset('assets/img/plants/basil.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Basil"></td>
                    <td><h6 class="mb-0 text-sm">Ocimum basilicum</h6></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Species</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Ocimum</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Vol. 1</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">(L.)</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">10/06/2023</span></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-success btn-link"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn btn-danger btn-link"><i class="material-icons">close</i></button>
                    </td>
                </tr>

                <tr>
                    <td><p class="mb-0 text-sm">2</p></td>
                    <td><img src="{{ asset('assets/img/plants/rose.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Rose"></td>
                    <td><h6 class="mb-0 text-sm">Rosa indica</h6></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Species</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Rosa</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Vol. 2</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">L.</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">15/07/2023</span></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-success btn-link"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn btn-danger btn-link"><i class="material-icons">close</i></button>
                    </td>
                </tr>

                <tr>
                    <td><p class="mb-0 text-sm">3</p></td>
                    <td><img src="{{ asset('assets/img/plants/mango.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Mango"></td>
                    <td><h6 class="mb-0 text-sm">Mangifera indica</h6></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Species</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Mangifera</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Vol. 4</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">L.</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">20/09/2023</span></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-success btn-link"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn btn-danger btn-link"><i class="material-icons">close</i></button>
                    </td>
                </tr>

                <tr>
                    <td><p class="mb-0 text-sm">4</p></td>
                    <td><img src="{{ asset('assets/img/plants/neem.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Neem"></td>
                    <td><h6 class="mb-0 text-sm">Azadirachta indica</h6></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Species</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Azadirachta</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Vol. 3</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">(A. Juss.)</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">02/01/2024</span></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-success btn-link"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn btn-danger btn-link"><i class="material-icons">close</i></button>
                    </td>
                </tr>

                <tr>
                    <td><p class="mb-0 text-sm">5</p></td>
                    <td><img src="{{ asset('assets/img/plants/tulsi.jpg') }}" class="avatar avatar-sm me-3 border-radius-lg" alt="Tulsi"></td>
                    <td><h6 class="mb-0 text-sm">Ocimum tenuiflorum</h6></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Species</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Ocimum</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">Vol. 5</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">L.</span></td>
                    <td class="text-center"><span class="text-secondary text-xs font-weight-bold">08/04/2024</span></td>
                    <td class="align-middle text-center">
                        <a class="btn btn-success btn-link"><i class="material-icons">edit</i></a>
                        <button type="button" class="btn btn-danger btn-link"><i class="material-icons">close</i></button>
                    </td>
                </tr>
            </tbody>
        </table>
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
