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
<section class="about-section py-5">
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
        <p class="lead about-desc mx-auto mb-4">
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
{{-- feature section --}}


{{-- article section --}}


{{-- motivate section --}}
<section class="motivation-section d-none d-lg-flex align-items-center justify-content-center overflow-hidden position-relative mx-auto" style="max-width: 1920px;">
    <div id="motivationCarousel" class="carousel slide carousel-fade w-100 h-100" data-bs-ride="carousel" data-bs-interval="3500">
        <div class="carousel-inner h-100">
            @foreach($motivations as $index => $quote)
            <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                 <div class="d-flex align-items-center justify-content-center h-100 w-100 px-3">
                    <p class="motivation-text mb-0">{{ $quote }}</p>
                 </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Mobile fallback (simpler height/font) --}}
<section class="motivation-section d-flex d-lg-none align-items-center justify-content-center overflow-hidden position-relative w-100 mx-auto" style="max-width: 1920px;">
    <div id="motivationCarouselMobile" class="carousel slide carousel-fade w-100 h-100" data-bs-ride="carousel" data-bs-interval="3500">
         <div class="carousel-inner h-100">
            @foreach($motivations as $index => $quote)
            <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                 <div class="d-flex align-items-center justify-content-center h-100 w-100 px-3">
                     <p class="motivation-text mobile mb-0">{{ $quote }}</p>
                 </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- timdev section --}}
<section class="team-section py-5 mt-5" >
    <div class="container-xl px-lg-5">
         <div class="text-center mb-5">
            <h2 class="team-header display-5 fw-bold fst-italic text-uppercase">LET’S MEET OUR TEAM</h2>
        </div>

        {{-- Desktop Team Carousel--}}
        <div id="teamCarousel" class="carousel slide d-none d-lg-block" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach(array_chunk($teamMembers, 4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-4 justify-content-center px-4">
                        @foreach($chunk as $member)
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="team-card position-relative">
                                <!-- Image Container -->
                                <div class="team-image-wrapper">
                                     <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="team-image">
                                </div>

                                <!-- Content Box -->
                                <div class="team-content">
                                    <h4 class="team-name">{{ $member['name'] }}</h4>
                                    <p class="team-moto mb-0">{{ $member['moto'] }}</p>
                                </div>
                                  <!-- Social Button -->
                                  <a href="{{ $member['social_link'] }}" class="team-social-btn" aria-label="Social Media">
                                      <i class="bi bi-arrow-right"></i>
                                  </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            @if(count($teamMembers) > 4)
            <button class="carousel-control-prev team-nav-btn start-0" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                <span class="carousel-control-icon-wrapper">
                    <i class="bi bi-chevron-left"></i>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next team-nav-btn end-0" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                <span class="carousel-control-icon-wrapper">
                    <i class="bi bi-chevron-right"></i>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
            @endif
        </div>

        {{-- Mobile Team Carousel --}}
        <div id="teamCarouselMobile" class="carousel slide d-lg-none" data-bs-ride="carousel" data-bs-interval="3000">
             <div class="carousel-inner">
                @foreach($teamMembers as $index => $member)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center px-2 pb-4">
                        <div class="team-card position-relative" style="max-width: 320px;">
                            <!-- Image Container -->
                            <div class="team-image-wrapper">
                                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="team-image">
                            </div>

                            <!-- Content Box -->
                            <div class="team-content">
                                <h4 class="team-name">{{ $member['name'] }}</h4>
                                <p class="team-moto mb-0">{{ $member['moto'] }}</p>
                            </div>
                                <!-- Social Button -->
                                <a href="{{ $member['social_link'] }}" class="team-social-btn" aria-label="Social Media">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>





@endsection
