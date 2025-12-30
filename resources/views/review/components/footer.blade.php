<footer class="w-100">
    <!-- Top Section: CTA -->
    <div class="bg-white py-5 text-center">
        <div class="container py-4">
             <h1 class="text-footer mb-4 display-5 text-dark">
                 Begin Your Journey With <span style="color: #3559DF;">RECALM</span>
             </h1>
             <!-- Button "Start Now" matched with Landing Page Header -->
             @auth
             <a class="btn-cta d-inline-flex align-items-center justify-content-center fw-bold text-decoration-none border-0 rounded-pill fs-2 fs-lg-2 px-4 px-lg-5 py-2 py-lg-1 text-white mt-2"
                href="{{ route('home') }}"
                role="button"
                aria-label="Masuk ke Dashboard">
                Dashboard
             </a>
             @else
             <a class="btn-cta d-inline-flex align-items-center justify-content-center fw-bold text-decoration-none border-0 rounded-pill fs-2 fs-lg-2 px-4 px-lg-5 py-2 py-lg-1 text-white mt-2"
                href="#"
                role="button"
                aria-label="Mulai perjalanan - Start Now"
                data-bs-toggle="modal"
                data-bs-target="#authModal">
                Start Now
             </a>
             @endauth
        </div>
    </div>

    <!-- Bottom Section: Info -->
    <div class="text-white py-5 mx-auto" style="background: linear-gradient(90deg, #1D307A 0%, #2945AD 48%, #5578FF 100%); max-width: 1920px;">
        <div class="footer-inner w-100 pt-4 pb-2">
            <div class="row g-4 justify-content-between text-start text-lg-start">
                <!-- Col 1: Brand -->
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <h3 class="fw-bold fs-2 mb-3 text-uppercase">RECALM</h3>
                    <p class="mb-4 text-white small opacity-75">
                        Copyright &copy; 2025 Recalm<br>
                        All rights reserved
                    </p>
                    <div class="d-flex gap-3">
                         <!-- Icons -->
                         <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 40px; height: 40px;">
                            <i class="bi bi-instagram"></i>
                         </a>
                         <a href="https://www.linkedin.com/company/recalm-health/posts/?feedView=all" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 40px; height: 40px;">
                            <i class="bi bi-linkedin"></i>
                         </a>
                         <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 40px; height: 40px;">
                            <i class="bi bi-twitter"></i>
                         </a>
                         <a href="#" class="text-white bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-decoration-none" style="width: 40px; height: 40px;">
                            <i class="bi bi-youtube"></i>
                         </a>
                    </div>
                </div>

                <!-- Col 2: Company -->
                <div class="col-6 col-lg-2 col-md-4">
                    <h5 class="fw-semibold mb-3">Company</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 small opacity-75">
                        <li><a href="/#about" class="text-white text-decoration-none">About us</a></li>
                        <li><a href="/#feature" class="text-white text-decoration-none">Features</a></li>
                        <li><a href="/#teamdev" class="text-white text-decoration-none">Team Dev</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Pricing</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Testimonials</a></li>
                    </ul>
                </div>

                <!-- Col 3: Support -->
                <div class="col-6 col-lg-2 col-md-4">
                    <h5 class="fw-semibold mb-3">Support</h5>
                     <ul class="list-unstyled d-flex flex-column gap-2 small opacity-75">
                        <li><a href="#" class="text-white text-decoration-none">Help center</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Terms of service</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Legal</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Privacy policy</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Status</a></li>
                    </ul>
                </div>

                 <!-- Col 4: Newsletter -->
                <div class="col-lg-3 col-md-4">
                     <h5 class="fw-semibold mb-3">Stay up to date</h5>
                     <form action="#" class="position-relative mt-2">
                         <input type="email" placeholder="Your email address"
                                class="form-control bg-white bg-opacity-25 border-0 text-white placeholder-white-50 pe-5 py-2">
                         <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y text-white p-2">
                             <i class="bi bi-send"></i>
                         </button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .text-footer {
        font-size: 2.5rem; /* Responsive default (Mobile) */
        font-weight: 900;
    }

    @media (min-width: 992px) {
        .text-footer {
            font-size: 4.4rem; /* Desktop */
        }
    }

    /* Replicate navbar padding for consistency */
    .footer-inner {
        padding-left: 140px;
        padding-right: 140px;
    }

    @media (max-width: 1200px) {
        .footer-inner {
            padding-left: 80px;
            padding-right: 80px;
        }
    }

    @media (max-width: 992px) {
        .footer-inner {
            padding-left: 24px;
            padding-right: 24px;
        }
    }
</style>
