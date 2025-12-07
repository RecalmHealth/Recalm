<section>
<aside class="sidebar d-none d-md-flex flex-column text-white">
    {{-- Logo --}}
    <div class="logo-recalm mx-auto">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo/RecalmLogo-White.png') }}" alt="RecalmLogo">
        </a>
    </div>
    {{-- Navigation --}}
    <nav class="sidebar-nav ps-4">
        <ul class="nav flex-column list-unstyled">
            <li class="nav-item mb-2 {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link d-flex align-items-center text-white">
                    <span class="icon d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/icon/dashboard.png') }}" width="34" height="34">
                    </span>
                    <span class="nav-text fw-light">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-2 {{ request()->routeIs('notes') ? 'active' : '' }}">
                <a href="{{ route('notes') }}" class="nav-link d-flex align-items-center text-white">
                    <span class="icon d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/icon/note.png') }}" width="34" height="34">
                    </span>
                    <span class="nav-text fw-light">Take Notes</span>
                </a>
            </li>
            <li class="nav-item mb-2 {{ request()->routeIs('chat') ? 'active' : '' }}">
                <a href="{{ route('chat') }}" class="nav-link d-flex align-items-center text-white">
                    <span class="icon d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/icon/Ai.png') }}" width="34" height="34">
                    </span>
                    <span class="nav-text fw-light">AI Chat</span>
                </a>
            </li>
            <li class="nav-item mb-2 {{ request()->routeIs('statistik') ? 'active' : '' }}">
                <a href="{{ route('statistik') }}" class="nav-link d-flex align-items-center text-white">
                    <span class="icon d-flex align-items-center justify-content-center">
                        <img src="{{ asset('images/icon/chart.png') }}" width="34" height="34">
                    </span>
                    <span class="nav-text fw-light">Mood Kamu</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
</section>
<style>
.sidebar {
    width: 362px;
    min-height: 100vh;
    height: 100%;
    background: linear-gradient(100deg, #4457a3ff 0, #5175F9 100%);
    box-sizing: border-box;
    position: sticky;
    top: 0;
    align-self: flex-start;
}
.sidebar .logo-recalm {
    width: 220px;
    height: 36px;
    margin-top: -4px;
    margin-bottom: 66px;
}
.sidebar .logo-recalm img {
    width: 220px;
    height: 36px;
    object-fit: contain;
}
.icon img {
    width: 30px;
    height: auto;
    filter: brightness(0) invert(1);
    transition: 0.2s ease;
}
.sidebar .nav-link .icon {
    margin-right: 22px;
}
.sidebar .nav-text {
    font-size: 18px;
}
.sidebar-nav .nav-link {
    padding: 6px 6px;
    border-radius: 10px;
    transition: 0.25s ease;
    border: 2px solid transparent;
}
.sidebar-nav .nav-link:hover {
    background: #ffffff;
    border-color: #ffffff;
    color: #5175F9 !important;
}
.sidebar-nav .nav-link:hover .nav-text {
    color: #5175F9 !important;
}
.sidebar-nav .nav-link:hover .icon img {
    filter: brightness(0) saturate(100%) invert(42%) sepia(96%)
            saturate(3256%) hue-rotate(219deg) brightness(95%) contrast(101%);
}
.nav-item.active .nav-link {
    background: #ffffff;
    border-color: #ffffff;
}
.nav-item.active .nav-link .nav-text {
    color: #5175F9 !important;
}
.nav-item.active .nav-link .icon img {
    filter: brightness(0) saturate(100%)
            invert(42%) sepia(96%) saturate(3256%)
            hue-rotate(219deg) brightness(95%) contrast(101%);
}
@media (max-width: 767.98px) {
    .sidebar {
        display: none !important;
    }
}
</style>