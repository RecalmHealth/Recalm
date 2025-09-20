@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar kiri -->
            <div class="col-md-3 bg-white d-none d-md-block sidebar">
                <h4 class="fw-bold">Pengaturan</h4>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('review.app.profile') }}"><i class="fas fa-user"></i> Profile</a>
                    <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-chart-bar"></i> Statistik Mood</a>
                    <a class="nav-link" href="{{ route('review.index') }}"><i class="fas fa-user-cog"></i> Review Note</a>
                    <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-graduation-cap"></i>Back to home</a>
                    <a class="nav-link text-danger" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout Account
                    </a>
                    <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </div>

            <!-- Sidebar untuk tampilan mobile -->
            <div class="col-12 d-md-none mb-3">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarNav" aria-expanded="false" aria-controls="sidebarNav">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <div class="collapse" id="sidebarNav">
                    <nav class="nav flex-column sidebar">
                        <a class="nav-link" href="{{ route('review.app.profile') }}"><i class="fas fa-user"></i> Profile</a>
                        <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-chart-bar"></i> Statistik
                            Mood</a>
                        <a class="nav-link" href="{{ route('review.index') }}"><i class="fas fa-user-cog"></i> Review
                            Note</a>
                        <a class="nav-link" href="#"><i class="fas fa-graduation-cap"></i> button opsional</a>
                        <a class="nav-link text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form-sidebar-mobile').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout Account
                        </a>
                        <form id="logout-form-sidebar-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Content area -->
            <div class="col-md-9 p-4">
                <h4>Review Notes</h4>
                <hr>
                @foreach ($notes as $note)
                    <div class="card border border-primary mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-primary fw-bold">{{ $note->Mood }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted fw-medium">{{ $note->created_at->format('Y-m-d') }}
                                </h6>
                                <p class="card-text m-0 fw-medium">{{ Str::limit($note->Note, 150) }}...</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
