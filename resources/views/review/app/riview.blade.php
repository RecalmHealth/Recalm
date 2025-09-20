@extends('layouts.app')

@section('title', 'Home')
@section('content')
<!--Sidebar kiri-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-white d-none d-md-block sidebar">
                <h4 class="fw-bold">Pengaturan</h4>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('review.app.profile') }}"><i class="fas fa-user"></i>Profile</a>
                    <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-chart-bar"></i>Statistik
                        Mood</a>
                    <a class="nav-link" href="#"><i class="fas fa-user-cog"></i>Review Note</a>
                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-graduation-cap"></i>Back to home</a>

                    <!-- Tombol Logout -->
                    <a class="nav-link text-danger" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout Account
                    </a>
                    <!-- Form Logout -->
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>

            <!--Bagian sidebar kalo tampilan mobile-->
            <div class="col-12 d-md-none">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarNav" aria-expanded="false" aria-controls="sidebarNav">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <div class="collapse" id="sidebarNav">
                    <nav class="nav flex-column sidebar">
                        <a class="nav-link" href="{{ route('review.app.profile') }}"><i class="fas fa-user"></i> Profile</a>
                        <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-chart-bar"></i>Statistik
                            Mood</a>
                        <a class="nav-link" href="#"><i class="fas fa-user-cog"></i>Riview Note</a>
                        <a class="nav-link" href="#"><i class="fas fa-graduation-cap"></i>button opsional</a>
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i>Logout Account</a>
                    </nav>
                </div>
            </div>

            <!--Content start-->
            <div class="col-md-9 p-4">
                <div class="card border border-primary mb-2">
                    <div class="card-body d-flex justify-content-space-beetwen align-items-center">
                        <div>
                            <h5 class="card-title text-primary fw-bold">SENANG</h5>
                            <h6 class="card-subtitle mb-2 text-muted fw-medium">2025-01-01</h6>
                            <p class="card-text m-0 fw-medium">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate ......</p>
                        </div>
                        <div class="btn">
                            <button type="button" class="btn btn-primary mb-3"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content end -->
        </div>
    </div>
    <!--Sidebar kiri end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
