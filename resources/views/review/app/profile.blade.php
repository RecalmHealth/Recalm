@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="container-fluid" style="min-height: 100vh;">
    <div class="row ps-5 pt-5">
        <div class="col-12 ps-md-5 pt-md-4">
            <h4 class="fw-bold mb-4" style="font-size: 24px;">Profil Pengguna {{ Auth::user()->name }}</h4>
            <hr class="w-100 mb-5" style="color: #dee2e6; opacity: 1;">

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-center mb-4 gap-4">
                    <div class="position-relative">
                        <!-- Preview Image -->
                        <img id="profilePreview"
                             src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default_profile.png') }}"
                             alt="Profile photo"
                             class="rounded-circle"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>
                    <div>
                        <label for="photo" class="btn btn-secondary btn-sm mb-2 px-3" style="background-color: #6c757d; border: none; font-size: 12px; border-radius: 4px;">
                            Pilih Foto
                        </label>
                        <input type="file" id="photo" name="photo" class="d-none" onchange="previewImage(event)">
                        <p class="text-danger m-0" style="font-size: 11px;">
                            * Gambar foto profile anda sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2 MB.
                        </p>
                    </div>
                </div>

                <div class="mb-4" style="max-width: 600px;">
                    <label for="fullName" class="form-label mb-2" style="font-weight: 500; font-size: 16px;">Nama Lengkap</label>
                    <input type="text" id="fullName" name="name" class="form-control p-2 ps-3"
                           value="{{ Auth::user()->name }}"
                           style="border-radius: 6px; border: 1px solid #ced4da; background-color: #f8f9fa00;">
                </div>

                <div class="mb-4" style="max-width: 600px;">
                    <label for="email" class="form-label mb-2" style="font-weight: 500; font-size: 16px;">Email</label>
                    <input type="email" id="email" name="email" class="form-control p-2 ps-3"
                           value="{{ Auth::user()->email }}"
                           readonly
                           style="border-radius: 6px; border: 1px solid #ced4da; background-color: #e9ecef;">
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold" style="background-color: #4361EE; border-color: #4361EE; border-radius: 6px;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        @endif
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profilePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
