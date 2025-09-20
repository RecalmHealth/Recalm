<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cssWeb/style.css">
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Side -->
            <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center bg-white">
                <img src="{{ Vite::asset('public/images/recalm.png') }}" alt="logo-recalm" class="mb-3"
                    style="width: 150px; height: auto;">
                <h2 class="fs-5 fw-bold mb-4">Login</h2>
                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" class="w-75">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password"
                            required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="mx-2 text-muted">Or Sign in with</span>
                        <hr class="flex-grow-1">
                    </div>
                    <div class="d-flex justify-content-center gap-5">
                        <button type="button" class="btn btn-light border">
                            <img src="{{ Vite::asset('public/images/google.png') }}" alt="Google" width="40">
                        </button>
                        <button type="button" class="btn btn-light border">
                            <img src="{{ Vite::asset('public/images/facebook.png') }}" alt="Facebook" width="40">
                        </button>
                    </div>
                    <br>
                    <p class="d-flex justify-content-center">Belum punya akun?
                        <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                    </p>
                </form>
            </div>

            <!-- Right Side -->
            <div class="col-lg-6 d-flex flex-column justify-content-center align-items-start"
                style="background-color: #54A8BF; border-top-left-radius: 45px; border-bottom-left-radius: 45px; position: relative; height: 100%;">
                <div class="mx-3">
                    <h4 class="fs-5 fw-bold mb-3 text-white">At Recalm,</h4>
                    <h2 class="fs-2 fw-bold mb-3 text-white">we believe that every journey begins with understanding
                        yourself.</h2>
                    <h4 class="fs-6 fw-bold mb-3 text-white">Take a step towards peace, resilience, and happiness.</h4>
                </div>
                <img src="{{ Vite::asset('public/images/hutan_1.png') }}" alt="hutan" class="d-block mx-auto"
                    style="position: absolute; bottom: 0; left: 0; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</body>

</html>
