@extends('layouts.dashboard')

@section('title', 'AI Chat')

@section('content')
<div class="container-fluid" style="height: 90vh;">
    <div class="row h-100 ps-lg-4 pt-4">
        <div class="col-12 h-100">
            <!-- Main Chat Card -->
            <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">

                <!-- Chat Header -->
                <div class="d-flex align-items-center px-4 py-3" style="background-color: #4361EE;">
                    <div class="position-relative">
                        <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi"
                             class="rounded-circle"
                             style="width: 50px; height: 50px; object-fit: cover; background-color: #fff; padding: 2px;">
                    </div>
                    <div class="ms-3 text-white">
                        <h5 class="fw-bold mb-0">Calmi</h5>
                        <small style="opacity: 0.9;">Your Support System Is Here!</small>
                    </div>
                </div>

                <!-- Chat Body -->
                <div class="card-body bg-white position-relative p-4" style="overflow-y: auto; background-image: url('{{ asset('images/chat-pattern.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

                    <!-- Incoming Message (Calmi) -->
                    <div class="d-flex align-items-start mb-4">
                        <img src="{{ asset('images/icon/calmi-profile.png') }}" alt="Calmi"
                             class="rounded-circle"
                             style="width: 40px; height: 40px; object-fit: cover; background-color: #eee; padding: 2px;">
                        <div class="ms-3 p-3 shadow-sm" style="background-color: #f0f0f0; border-radius: 20px 20px 20px 0px; max-width: 70%;">
                            <p class="mb-0 text-dark">Gimana keadaan kamu hari ini?</p>
                        </div>
                    </div>

                </div>

                <!-- Chat Footer (Input) -->
                <div class="card-footer bg-white border-0 p-4">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Text Input -->
                        <div class="flex-grow-1 position-relative">
                            <input type="text" class="form-control py-3 px-4 shadow-sm"
                                   placeholder="Type your message here..."
                                   style="border-radius: 30px; border: 1px solid #e0e0e0; padding-right: 50px;">
                            <button class="btn position-absolute top-50 end-0 translate-middle-y me-2" style="border: none; background: none;">
                                <img src="{{ asset('images/icon/send-icon.png') }}" alt="Send" style="width: 24px; height: 24px;">
                            </button>
                        </div>

                        <!-- Mic Button -->
                        <button class="btn btn-primary d-flex align-items-center justify-content-center shadow-md"
                                style="width: 54px; height: 54px; border-radius: 15px; background-color: #4361EE; border: none;">
                            <i class="bi bi-mic-fill fs-4"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

