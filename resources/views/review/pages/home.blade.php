@extends('layouts.app')

@section('title', 'Home')
@section('content')
<header class="container-fluid bg-primary text-white text-center mb-4">
    <div class="row d-flex align-items-center" style="min-height: 50vh;">
        <!-- Bagian Kiri -->
        <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
            <h1 class="mb-3">Gimana Hari Mu?</h1>
            <h3>Ingat, kamu tidak sendirian dalam menghadapi hari-harimu.</h3>
        </div>

        <!-- Bagian Kanan -->
        <div class="col-12 col-md-6">
            <img src="{{ Vite::asset('public/images/utama.png') }}" alt="utama" class="img-fluid" style="max-height: 50vh;">
        </div>
    </div>
</header>

    <!-- Welcome Section end -->
    <div class="container my-4">

        <!-- Mood Buttons -->
        <section>
            <h2 class="mb-3">Mood Hari Ini</h2>
            <div class="row g-3">
                <!-- Other Buttons -->
                <div class="col-12 ">
                   <a href="{{ route('notes') }}"> <button class="btn btn-primary w-100 py-3"><h2><i class="bi bi-journals"></i> Notes</h2></button></a>
                </div>
                <div class="col-12 col-md-6">
                   <a href="{{ route('statistik') }}"> <button class="btn btn-primary w-100 py-3"><h2><i class="bi bi-bar-chart"></i> Statistik </h2></button></a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="{{ route('chat') }}"> <button class="btn btn-primary w-100 py-3"><h2><i class="bi bi-chat-dots"></i>  Perlu Teman Cerita?</h2></button></a>
                </div>
            </div>
        </section>
        <!-- Mood Buttons end -->

        <!-- Artikel Section -->
        <section class="mt-5">
            <h2 class="mb-3">Artikel</h2>
            <div class="row g-3">
                <!-- Card 1 -->
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <img src="{{ Vite::asset('public/images/card2.png') }}" class="card-img-top fixed-image" alt="Artikel 1">

                        <div class="card-body">
                            <h6 class="text-muted">English</h6>
                            <h5 class="card-title"><b>Understanding your mental health and looking after others</b></h5>
                            <p class="card-text">Data from AIHW Australian Institute of Health...</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-primary">
                            <small class="text-white">October 13, 2022</small>
                            <a href="https://www.sixdegreesexecutive.com.au/your-career/understanding-your-mental-health" class="btn btn-outline-primary btn-sm bg-light text-primary">Lebih lengkap</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <img src="{{ Vite::asset('public/images/card3.png') }}" class="card-img-top fixed-image" alt="Artikel 2">
                        <div class="card-body">
                            <h6 class="text-muted">Indonesia</h6>
                            <h5 class="card-title"><b>Mengenali Definisi Tepat dari Kesehatan Mental dan Dampaknya</b></h5>
                            <p class="card-text">Jakarta Setiap tahun, dunia memperingati Hari Kesehatan...</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-primary">
                            <small class="text-white">Mei 26, 2023</small>
                            <a href="https://www.halodoc.com/artikel/mengenali-definisi-tepat-dari-kesehatan-mental-dan-dampaknya" class="btn btn-outline-primary btn-sm bg-light text-primary">Lebih lengkap</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-12 col-md-4">
                    <div class="card h-100">
                        <img src="{{ Vite::asset('public/images/card1.png') }}" class="card-img-top fixed-image" alt="Artikel 3">
                        <div class="card-body">
                            <h6 class="text-muted">English</h6>
                            <h5 class="card-title"><b>Building an international mental health support group for people in science</b></h5>
                            <p class="card-text">Jaishree Subrahmanium is a botanist who did her PhD...</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-primary">
                            <small class="text-white">March 04, 2021</small>
                            <a href="https://indiabioscience.org/columns/conversations/building-an-international-mental-health-support-group-for-people-in-science" class="btn btn-outline-primary btn-sm bg-light text-primary">Lebih lengkap</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Artikel Section end -->
    </div>
    <!-- Footer -->
@endsection('content')
