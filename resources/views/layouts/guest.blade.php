<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Recalm', 'Recalm')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        @vite('resources/sass/app.scss')

    <link rel="icon" type="image/png" href="{{ asset('images/recalm.png') }}">
</head>
<body>
    @include('review.components.navbar')

    <main class="py-4">
        @yield('content')
    </main>

    @include('review.components.footer')
    @vite('resources/js/app.js')


{{-- Login / Register Modal --}}
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 p-4" style="border-radius: 20px;">

      {{-- Modal Header (Close button & Branding) --}}
      <div class="position-relative text-center mb-4">
        <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
        <h3 class="fw-bold" style="color: #4361EE;">RECALM</h3>
        <h5 class="fw-bold mt-2" id="modalTitle">Login</h5>
      </div>

      <div class="modal-body p-0">

        {{-- LOGIN FORM --}}
        <div id="login-form-section">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="login-email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control py-2 ps-3" id="login-email" name="email" placeholder="contoh@email.com" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-4">
                    <label for="login-password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control py-2 ps-3" id="login-password" name="password" placeholder="*******" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary py-2 fw-bold" style="background-color: #4361EE; border-color: #4361EE; border-radius: 8px;">Login</button>
                </div>

                {{-- Divider --}}
                <div class="d-flex align-items-center mb-4">
                    <hr class="flex-grow-1 text-muted">
                    <span class="mx-3 text-muted small">Or Login With</span>
                    <hr class="flex-grow-1 text-muted">
                </div>

                {{-- Social Login --}}
                <div class="d-flex justify-content-center mb-4">
                    <a href="{{ route('auth.google') }}" class="btn border-0 p-0">
                        <img src="{{ asset('images/google.png') }}" alt="Google" width="30">
                    </a>
                </div>

                {{-- Toggle Link --}}
                <div class="text-center">
                    <span class="text-muted">Belum punya akun? </span>
                    <a href="#" class="text-decoration-none fw-bold" onclick="toggleAuthMode('register'); return false;" style="color: #4361EE;">Daftar Sekarang</a>
                </div>
            </form>
        </div>

        {{-- REGISTER FORM (Hidden by default) --}}
        <div id="register-form-section" style="display: none;">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="register-name" class="form-label fw-bold">Full Name</label>
                    <input type="text" class="form-control py-2 ps-3 @error('name') is-invalid @enderror" id="register-name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="register-email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control py-2 ps-3 @error('email') is-invalid @enderror" id="register-email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="register-password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control py-2 ps-3 @error('password') is-invalid @enderror" id="register-password" name="password" placeholder="*******" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary py-2 fw-bold" style="background-color: #4361EE; border-color: #4361EE; border-radius: 8px;">Register</button>
                </div>

                 {{-- Divider --}}
                 <div class="d-flex align-items-center mb-4">
                    <hr class="flex-grow-1 text-muted">
                    <span class="mx-3 text-muted small">Or Register With</span>
                    <hr class="flex-grow-1 text-muted">
                </div>

                {{-- Social Login --}}
                <div class="d-flex justify-content-center mb-4">
                    <a href="{{ route('auth.google') }}" class="btn border-0 p-0">
                        <img src="{{ asset('images/google.png') }}" alt="Google" width="30">
                    </a>
                </div>

                {{-- Toggle Link --}}
                <div class="text-center">
                    <span class="text-muted">Sudah punya akun? </span>
                    <a href="#" class="text-decoration-none fw-bold" onclick="toggleAuthMode('login'); return false;" style="color: #4361EE;">Login</a>
                </div>
            </form>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
function toggleAuthMode(mode) {
    const loginForm = document.getElementById('login-form-section');
    const registerForm = document.getElementById('register-form-section');
    const modalTitle = document.getElementById('modalTitle');

    if (mode === 'register') {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        modalTitle.innerText = 'Register';
    } else {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        modalTitle.innerText = 'Login';
    }
}

</script>

{{-- Auto-open registration modal on error --}}
@if($errors->any() && ($errors->has('name') || old('name')))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check if bootstrap is available
            if (typeof bootstrap !== 'undefined') {
                var authModalInfo = document.getElementById('authModal');
                if(authModalInfo) {
                    var myModal = new bootstrap.Modal(authModalInfo);
                    myModal.show();
                    // Ensure global function is available or inline the logic if needed context is lost.
                    // Since it's in a separate script tag but same page, global window scope functions work.
                    if (typeof toggleAuthMode === 'function') {
                        toggleAuthMode('register');
                    } else {
                         // Fallback inline logic if function not found
                        document.getElementById('login-form-section').style.display = 'none';
                        document.getElementById('register-form-section').style.display = 'block';
                        document.getElementById('modalTitle').innerText = 'Register';
                    }
                }
            } else {
                console.error("Bootstrap is not loaded yet.");
            }
        });
    </script>
@endif

</body>
</html>
