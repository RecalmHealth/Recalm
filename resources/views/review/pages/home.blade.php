
@extends('layouts.dashboard')

@section('title', 'Home')

@section('content')
<div class="home-content p-0">
  <!-- gunakan padding utilitas Bootstrap agar konsisten -->
<div class="row g-0 g-lg-3 mb-2 align-items-stretch px-3 px-lg-4">
    <!-- mood: full width on mobile, center on mobile, left on lg+ -->
    <div class="col-12 col-lg-8 mb-2 mb-lg-0 d-flex justify-content-center justify-content-lg-start">
      <!-- wrapper untuk mengontrol lebar maksimal di layar besar -->
      <div class="w-100" style="max-width: 920px;">
        @include('review.components.mood')
      </div>
    </div>

    <!-- calendar: full width on mobile, center on mobile, left on lg+ (atau end jika mau) -->
    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
      <div class="w-100" style="max-width: 380px;">
        @include('review.components.calendar')
      </div>
    </div>
  </div>

  @include('review.components.artikel')
</div>
@endsection