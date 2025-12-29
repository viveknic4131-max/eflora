@extends('theme.layouts.app')

@section('title', 'What’s New | E-Flora')

@section('content')

{{-- BREADCRUMB / HEADER --}}
<section class="d-flex align-items-center text-white position-relative"
    style="background: url('{{ asset('images/breadcrumb.jpg') }}') center center / cover no-repeat; min-height: 300px;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
    <div class="container position-relative text-center py-5">
        <h1 class="display-6 fw-bold text-uppercase text-white">What’s New</h1>
        <p class="lead mb-0">Latest updates & announcements</p>
    </div>
</section>

{{-- NEWS LIST --}}
<section class="py-5 bg-light">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">

                        @forelse($news as $item)
                            <div class="d-flex align-items-start gap-3 py-3 border-bottom">

                                <i class="fa fa-arrow-circle-o-right text-danger fs-5 mt-1"></i>

                                <div class="flex-grow-1">
                                    <a href="{{ $item->file_path ? asset($item->file_path) : '#' }}"
                                       target="_blank"
                                       class="fw-semibold text-decoration-none text-dark">
                                        {{ $item->title }}
                                    </a>

                                    @if($item->created_at)
                                        <div class="small text-muted mt-1">
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <p class="text-center text-muted mb-0">
                                No updates available at the moment.
                            </p>
                        @endforelse

                    </div>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
