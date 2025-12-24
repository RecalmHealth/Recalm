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

                {{-- Bagian Foto (Belum Ada) --}}

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
