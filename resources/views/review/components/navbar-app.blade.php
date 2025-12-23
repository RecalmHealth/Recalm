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
<a href="{{ url('/') }}" class="btn btn-primary">Login / Register</a>
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
            <img src="{{ asset('images/icon/AI.png') }}" width="28" alt="AI Chat"> AI Chat
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



{{-- minimal custom CSS for spacing / typography (let it live inside component or external file) --}}
<style>
.top-nav {
    padding: 8px 30px;
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
