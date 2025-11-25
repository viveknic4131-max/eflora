<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky">
    <div class="container-fluid py-1 px-3">

        <!-- Breadcrumb & Page Title -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            {{-- <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6> --}}
        </nav>

        <!-- Navbar Right -->
        <div class="ms-auto d-flex align-items-center">

            <!-- Search Box -->
            <div class="input-group input-group-outline me-3">
                <label class="form-label">Type here...</label>
                <input type="text" class="form-control">
            </div>


            <!-- Profile Dropdown -->
            <li class="nav-item dropdown list-unstyled">
                <a class="nav-link p-0 d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/img/team-1.jpg') }}" class="avatar avatar-sm rounded-circle me-2">
                    <span class="d-none d-sm-inline">{{auth()->user()->name ?? 'Admin'}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item border-radius-md" href="{{route('profile')}}">Profile</a>
                    </li>
                       <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
                    <li>
                       <a href="javascript:;" class="dropdown-item border-radius-md"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign
                            Out</span>
                    </a>
                    </li>
                </ul>
            </li>

        </div>

    </div>
</nav>
