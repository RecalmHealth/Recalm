<nav class="top-nav navbar">
  <div class="container-fluid d-flex align-items-center justify-content-between px-3">

    {{-- LEFT: greeting (always visible) --}}
    <div class="d-flex align-items-center">
      <div class="greeting">
        <p class="greeting-sub mb-0">Hello, Welcome Back!</p>
        {{-- tampilkan nama user bila auth, else "Guest" --}}
        <h5 class="greeting-name mb-0">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h5>
      </div>
    </div>

    {{-- RIGHT: notif + profile (desktop) or notif + hamburger (mobile) --}}
    <div class="d-flex align-items-center gap-3">

      {{-- Notification: selalu tampil --}}
      <a href="#" class="notif-btn" aria-label="Notifications">
        <img src="{{ asset('images/icon/notif.png') }}" alt="notifIcon" width="26" height="26">
      </a>

      {{-- Avatar (desktop only) --}}
      <div class="d-none d-md-block">
        @guest
          {{-- Guest Profile Button -> Triggers Auth Modal --}}
          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="modal" data-bs-target="#authModal">
               <img src="{{ asset('images/default_profile.png') }}" alt="Guest Profile" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
            </a>
          </div>
        @else
          {{-- Avatar + dropdown --}}
          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#"
               id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default_profile.png') }}"
                   alt="Profile photo" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li><a class="dropdown-item" href="{{ route('review.app.profile') }}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
              </li>
            </ul>
          </div>
        @endguest
      </div>

      {{-- Hamburger (mobile only) --}}
      <button class="btn btn-link p-0 d-flex d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
              aria-controls="mobileMenu" aria-label="Open menu">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 6h18M3 12h18M3 18h18" stroke="#243b83" stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>
  </div>
</nav>

{{-- Mobile Offcanvas (contains profile or login/register + sidebar nav items) --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">

    {{-- Profile area --}}
    <div class="mb-3 d-flex align-items-center gap-3">
      <img src="{{ Auth::check() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default_profile.png') }}"
           alt="avatar" class="rounded-circle" style="width:56px; height:56px; object-fit:cover;">
      <div>
        <div class="fw-semibold">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
        @guest
          <div class="small text-muted">Silakan login atau registrasi</div>
        @else
          <div class="small text-muted">{{ Auth::user()->email }}</div>
        @endguest
      </div>
    </div>

    {{-- If guest show login/register buttons --}}
    @guest
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authModal" data-bs-dismiss="offcanvas">Login / Register</button>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Home</a>
      </div>
    @else
      {{-- quick links for logged in user --}}
      <div class="list-group mb-3">
        <a href="{{ route('review.app.profile') }}" class="list-group-item list-group-item-action">Profile</a>
        <a class="list-group-item list-group-item-action text-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Logout</a>
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
      </div>
    @endguest

    {{-- Nav items (reused from sidebar) --}}
    <nav>
      <ul class="list-unstyled">
        <li class="mb-2">
          <a href="{{ route('home') }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark p-2 rounded {{ request()->routeIs('home') ? 'bg-primary text-white' : '' }}">
            <img src="{{ asset('images/icon/dashboard.png') }}" width="28" alt="Dashboard"> Dashboard
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('notes') }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark p-2 rounded {{ request()->routeIs('notes') ? 'bg-primary text-white' : '' }}">
            <img src="{{ asset('images/icon/note.png') }}" width="28" alt="Take Notes"> Take Notes
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('chat') }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark p-2 rounded {{ request()->routeIs('chat') ? 'bg-primary text-white' : '' }}">
            <img src="{{ asset('images/icon/Ai.png') }}" width="28" alt="AI Chat"> AI Chat
          </a>
        </li>
        <li class="mb-2">
          <a href="{{ route('statistik') }}" class="d-flex align-items-center gap-3 text-decoration-none text-dark p-2 rounded {{ request()->routeIs('statistik') ? 'bg-primary text-white' : '' }}">
            <img src="{{ asset('images/icon/chart.png') }}" width="28" alt="Mood Kamu"> Mood Kamu
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>

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
                    <input type="text" class="form-control py-2 ps-3" id="register-name" name="name" placeholder="Nama Lengkap" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-3">
                    <label for="register-email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control py-2 ps-3" id="register-email" name="email" placeholder="contoh@email.com" style="border-radius: 8px; border: 1px solid #ced4da;" required>
                </div>
                <div class="mb-4">
                    <label for="register-password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control py-2 ps-3" id="register-password" name="password" placeholder="*******" style="border-radius: 8px; border: 1px solid #ced4da;" required>
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

{{-- minimal custom CSS for spacing / typography (let it live inside component or external file) --}}
<style>
.top-nav {
    padding: 8px 50px;
    margin-top: 1.5rem
}
.greeting-sub {
  font-size: 0.8125rem;
  color: #6c77a6; /* muted blue */
}
.greeting-name {
  font-size: 1.13rem;
  color: #112269;
  font-weight: bold;
  letter-spacing: 0.2px;
}

/* notif icon */
.notif-btn img { display:block; }

/* Offcanvas list items */
.offcanvas .list-unstyled a { color: #243b83; }
.offcanvas .list-unstyled a img { filter: none; }


/* small tweak: ensure dropdown menu z-index higher than other components */
.dropdown-menu { z-index: 2000; }

@media (max-width: 767.98px) {
.top-nav {
    padding: 8px 0px;
    margin-top: 0;
}

.offcanvas .list-unstyled a img {
    filter: brightness(0) saturate(100%) invert(23%) sepia(65%) saturate(1400%) hue-rotate(210deg) brightness(90%) contrast(95%);
}
}
</style>
