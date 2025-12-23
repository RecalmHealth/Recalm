<style>
    .btn-gradient {
    background-image: linear-gradient(
        90deg,
        #1D307A 0%,
        #2945AD 48%,
        #5578FF 100%
    );
    border: none;
}
.nav-link {
    position: relative;
    display: inline-block; /* PENTING */
}

.navbar-inner {
    padding-left: 140px;
    padding-right: 140px;
}

@media (max-width: 1200px) {
    .navbar-inner {
        padding-left: 80px;
        padding-right: 80px;
    }
}

@media (max-width: 992px) {
    .navbar-inner {
        padding-left: 24px;
        padding-right: 24px;
    }
}

.nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -1px;
    width: 100%;
    height: 2px;
    background-color: #2945AD;
    transform: translateX(-50%) scaleX(0);
    transform-origin: center;
    transition: transform 0.3s ease;
}

.nav-link:hover::after {
    transform: translateX(-50%) scaleX(1);
}

.nav-link.active::after {
    transform: translateX(-50%) scaleX(1);
}

@media (max-width: 991.98px) {
    .offcanvas {
        width: 50% !important;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-2">
    <div class="container-fluid navbar-inner">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img
                src="{{ Vite::asset('public/images/logo/Recalm-Blue.png') }}"
                alt="Logo Recalm"
                class="h-auto"
                style="max-width:130px;"
            >
        </a>

        <!-- Hamburger -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu (Offcanvas) -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" data-bs-scroll="false">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title fw-bold text-primary" id="offcanvasNavbarLabel">Recalm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-lg-auto align-items-center align-items-lg-center text-center gap-lg-3 fs-5">
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-medium" href="#">Recalm</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary fw-medium" href="#">Features</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary fw-medium" href="#">Article</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary fw-medium" href="#">Dev Team</a>
                    </li>

                    <!-- Button (SEMANTIC) -->
                    <li class="nav-item">
                        <button class="btn btn-gradient fw-bold text-light rounded-pill px-4 py-2 py-lg-1 mt-2 mt-lg-0"
                           data-bs-toggle="modal" data-bs-target="#authModal">
                            Start Now
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
// untuk navbar items saat aktif
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function () {
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>
