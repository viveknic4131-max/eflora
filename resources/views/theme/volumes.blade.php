@extends('theme.layouts.app')

@section('title', $mode . ' | E-Flora')

@section('content')

    {{-- Hero Section --}}
    <section class="d-flex align-items-center text-white position-relative"
        style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 350px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4);"></div>
        <div class="container position-relative text-center py-5">
            <h1 class="display-5 fw-bold text-white">{{ $mode }}</h1>
            {{-- <p class="lead fst-italic">{{ $mode ?? 'No common name available.' }}</p> --}}
        </div>
    </section>
<div class="container py-4">
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
        @foreach (range('A', 'Z') as $alphabet)
            <a href="{{ route('checklist.volume', ['letter' => $alphabet, 'code' => request('code')]) }}"
                class="px-2 {{ request('letter') == $alphabet ? 'text-primary fw-bold' : '' }}">
                {{ $alphabet }}
            </a>
        @endforeach


        <a href="{{ route('checklist.volume', ['code' => request('code')]) }}" class="btn btn-sm btn-outline-danger ms-3">
            Clear
        </a>
    </div>
</div>
    <div class="container py-4">
        <ul class="list-group shadow-sm">
            @forelse($bsiVolume as $volume)
                <li class="list-group-item list-group-item-action d-flex align-items-center justify-content-start">
                    <span class="me-2 text-success">&bull;</span> <!-- Green bullet -->
                    <a href="{{ route('get.family', ['volume' =>$volume->volume_code]) }}" class="flex-grow-1 text-decoration-none text-dark">
                        {{ ucfirst($volume->name) }}
                    </a>
                </li>
            @empty
                <p class="text-center text-muted">No volumes found.</p>
            @endforelse
        </ul>

        {{-- Pagination --}}
        <div class="mt-4 d-flex justify-content-center mb-5">
            {{ $bsiVolume->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <style>
        /* Hover effect using Bootstrap utilities */
        .list-group-item-action:hover {
            background-color: #d4edda;
            /* Light green */
            color: #155724;
            /* Dark green text */
            transition: background-color 0.3s, color 0.3s;
        }

        /* Optional: make link text take full width */
        .list-group-item a {
            display: block;
        }
    </style>


@endsection
