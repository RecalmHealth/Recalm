@extends('layouts.guest')

@section('title', 'Home Recalm')

@section('content')
{{-- header section --}}
<section class="hero position-relative bg-white pb-0 pt-0 overflow-hidden d-flex align-items-end" aria-label="Hero: Mental Health Awareness">
    <div class="container-xl position-relative z-1 w-100">
        <div class="row align-items-center w-100 h-100">
            {{-- sisi kiri --}}
            <div class="hero-content col-lg-6 ps-lg-5 mt-0 mb-4">
                <h1 class="hero-title mb-3 fst-italic text-uppercase">
                    <span class="d-inline-block">
                        <span class="text-solid d-inline-block">YOU ARE</span>
                        <span class="text-gradient d-inline-block"> NOT ALONE,</span>
                    </span><br>
                    <span class="line-2 text-gradient d-inline-block">WE’RE WITH YOU</span>
                </h1>
                <p class="hero-sub fw-light mt-0 mb-2 mb-lg-3 color-var">
                    Recalm hadir untuk menemani kamu mengenali, menjaga,
                    dan mengembangkan kesehatan emosimu.
                </p>
                <a class="btn-cta d-inline-flex align-items-center justify-content-center fw-bold text-decoration-none border-0 rounded-pill fs-4 px-4 py-2 text-white" href="#" role="button" aria-label="Mulai perjalanan - Begin Your Journey" data-bs-toggle="modal" data-bs-target="#authModal"> Begin Your Journey </a>
            </div>
            {{-- sisi kanan --}}
            <div class="col-lg-6 text-lg-end text-center pe-lg-5 mt-4 mt-lg-0 d-flex align-items-end justify-content-center justify-content-lg-end">
                <figure class="m-0 d-flex align-items-end">
                    <img class="hero-illustration img-fluid d-block mx-auto mb-0" src="{{ asset('images/landing-02.png') }}" alt="Ilustrasi kesehatan mental">
                </figure>
            </div>
        </div>
    </div>
    <!-- rumput -->
    <img class="hero-ground  z-0 m-0 p-0" src="{{ asset('images/landing-01.png') }}" alt="" aria-hidden="true">
</section>

{{-- about section --}}
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center hero-about">
      <!-- left: ilustrasi -->
      <div class="col-12 col-lg-6 text-center mb-4 mb-lg-0">
        <img src="{{ asset('images/about-img.png') }}"
             alt="Mental Health Illustration"
             class="about-img img-fluid rounded-4 mx-auto d-block">
      </div>

      <!-- right: logo, deskripsi, benefit -->
      <div class="col-12 col-lg-6">
        <!-- Logo (center) -->
        <img src="{{ asset('images/Recalm-about02.png') }}"
             alt="Logo Recalm"
             class="about-logo mx-auto d-block mb-3" />

        <!-- Deskripsi (center block, teks justify di CSS) -->
        <p class="lead text-muted about-desc mx-auto mb-4">
          Recalm adalah sebuah platform berbasis website yang membantu
          individu dalam menjaga dan meningkatkan kesehatan mental
          melalui konten edukatif, fitur konsultasi, serta dukungan
          komunitas yang aman dan nyaman.
        </p>

        <!-- Benefit list (center block). gunakan utilitas Bootstrap ps-0 & mb-0 -->
        <ul class="list-unstyled benefit-about mx-auto ps-0 mb-0">
          <li class="benefit-item d-flex align-items-center">
            <span class="benefit-icon flex-shrink-0 me-3" aria-hidden="true">
              <img src="{{ asset('images/About-01.png') }}" alt="" width="44" height="44">
            </span>
            <span class="benefit-text">Temani Perjalanan Kesehatan Mentalmu</span>
          </li>

          <li class="benefit-item d-flex align-items-center">
            <span class="benefit-icon flex-shrink-0 me-3" aria-hidden="true">
              <img src="{{ asset('images/About-02.png') }}" alt="" width="44" height="44">
            </span>
            <span class="benefit-text">Ruangan Aman untuk Mengenal Dirimu</span>
          </li>

          <li class="benefit-item d-flex align-items-center">
            <span class="benefit-icon flex-shrink-0 me-3" aria-hidden="true">
              <img src="{{ asset('images/About-03.png') }}" alt="" width="44" height="44">
            </span>
            <span class="benefit-text">Your Daily Mental Wellness Companion</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>




@endsection
