@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-white d-none d-md-block sidebar min-vh-100">
                <h4 class="fw-bold">Pengaturan</h4>
                <nav class="nav flex-column">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i>Profile</a>
                    <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-chart-bar"></i>Statistik
                        Mood</a>
                    <a class="nav-link" href="{{ route('review.index') }}"><i class="fas fa-user-cog"></i>Review Note</a>
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
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
                        <a class="nav-link" href="{{ route('statistik') }}"><i class="fas fa-id-card"></i>Statistik
                            Mood</a>
                        <a class="nav-link" href="{{ route('review.index') }}"><i class="fas fa-user-cog"></i>Review
                            note</a>
                        <a class="nav-link" href="#"><i class="fas fa-graduation-cap"></i>button opsional</a>


                        <!-- Tombol Logout -->
                        <a class="nav-link text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout Account
                        </a>
                        <!-- Form Logout -->
                        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </nav>
                </div>
            </div>

            <!--Content start-->
            <div class="col-md-9 p-4">
                <h4>Profil Pengguna</h4>
                <hr>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <!-- Tambahkan ID 'profilePreview' untuk mengganti gambar dengan JavaScript -->
                            <img id="profilePreview"
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default_profile.png') }}"
                                alt="Profile photo" class="profile-photo">

                        </div>
                        <div class="col-md-10">
                            <label for="photo" class="btn btn-upload" style="background-color: #343a40; color: #fff;">
                                Pilih Foto
                            </label>
                            <input type="file" id="photo" name="photo" class="form-control d-none"
                                onchange="previewImage(event)">
                            <p class="text-muted mt-2"><span class="text-danger">*</span> Gambar Profile Anda
                                sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2MB.</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                        <input type="text" id="fullName" name="name" class="form-control"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ Auth::user()->email }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary px-3">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- content end -->

    <script>
        function previewImage(event) {
            const input = event.target; // Ambil elemen input file
            const preview = document.getElementById('profilePreview'); // Ambil elemen img untuk preview

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                // Ketika file selesai dibaca
                reader.onload = function(e) {
                    preview.src = e.target.result; // Ganti src gambar dengan file yang dipilih
                }

                reader.readAsDataURL(input.files[0]); // Baca file sebagai data URL
            }
        }
    </script>

@endsection
