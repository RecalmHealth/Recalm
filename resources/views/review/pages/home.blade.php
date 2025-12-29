
@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')
<div class="home-content p-0">
  <div class="row g-0 g-lg-3 mb-2 align-items-stretch px-3 px-lg-4">
    <!-- Mood Section -->
    <div class="col-12 col-lg-8 mb-2 mb-lg-0 d-flex justify-content-center justify-content-lg-start">
      <div class="w-100" style="max-width: 920px;">
        @include('review.components.mood')
      </div>
    </div>

    <!-- Calendar Section -->
    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
      <div class="w-100" style="max-width: 380px;">
        @include('review.components.calendar')
      </div>
    </div>
  </div>

  @include('review.components.artikel')
</div>
@endsection