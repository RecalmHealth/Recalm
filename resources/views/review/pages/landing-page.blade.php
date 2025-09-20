@extends('layouts.guest')

@section('title', 'Mental Health Awareness')

@section('content')
<section class="py-5 bg-light">
    <div class="container d-flex flex-column flex-md-row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <h1 class="display-5 fw-bold text-primary">Take Care of Your Mental Health</h1>
            <p class="lead text-secondary mt-3">
                Your mind matters as much as your body.
                Let’s build awareness and support each other for better mental well-being.
            </p>
            <a href="#learn-more" class="btn btn-primary btn-lg mt-3">Learn More</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/utama.png') }}"
                 alt="Mental Health Illustration"
                 class="img-fluid rounded-4 shadow-sm w-75">
        </div>
    </div>
</section>
@endsection
