@extends('theme.layouts.app')

@section('title', 'About | E-Flora')

@section('content')
<!-- Hero Section -->
<section class="vh-100 d-flex align-items-center text-white position-relative"
         style="background: url('{{ asset('images/horobanner.jpg') }}')  center/cover no-repeat;">

  <!-- Overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"></div>

  <!-- Full Width Container -->
  <div class="container-fluid position-relative text-center">
    <nav aria-label="breadcrumb" class="d-inline-block mb-3">
      <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-white text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
      </ol>
    </nav>
    <h1 class="display-3 fw-bold">About Us</h1>
    <p class="lead">This is a full screen hero section after navbar with container-fluid.</p>
  </div>
</section>


@endsection
