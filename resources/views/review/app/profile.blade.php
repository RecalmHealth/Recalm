@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="container-fluid" style="min-height: 100vh;">
    <div class="row ps-5 pt-5">
        <div class="col-12 ps-md-5 pt-md-4">
            <h4 class="fw-bold mb-4" style="font-size: 24px;">Profil Pengguna {{ Auth::user()->name }}</h4>
            <hr class="w-100 mb-5" style="color: #dee2e6; opacity: 1;">
            
        </div>
    </div>
</div>
@endsection