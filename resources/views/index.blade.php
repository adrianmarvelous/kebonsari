    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Kelurahan Kebonsari - Kota Surabaya</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <link rel="icon" href="{{ asset('templetes/kaiadmin-lite/assets/img/kaiadmin/favicon.ico') }}"
            type="image/x-icon" />

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Summernote -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <style>
            :root {
                --primary: #1a73e8;
                --primary-dark: #0d47a1;
                --primary-light: #e8f0fe;
                --accent: #34a853;
                --accent-light: #e6f4ea;
                --warning-color: #fbbc04;
                --danger-color: #ea4335;
                --dark: #1f2937;
                --gray: #6b7280;
                --light-gray: #f3f4f6;
            }

            * {
                font-family: 'Inter', 'Poppins', sans-serif;
            }

            body {
                background: #f8fafc;
                color: var(--dark);
                overflow-x: hidden;
            }

            /* ===== NAVBAR ===== */
            .navbar-public {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                box-shadow: 0 1px 3px rgba(0,0,0,0.06);
                padding: 12px 0;
                transition: all 0.3s ease;
                z-index: 1050;
            }
            .navbar-public .navbar-brand {
                font-weight: 800;
                font-size: 1.4rem;
                color: var(--primary-dark);
                letter-spacing: -0.5px;
            }
            .navbar-public .navbar-brand span {
                color: var(--primary);
            }
            .navbar-public .nav-link {
                font-weight: 500;
                color: var(--dark);
                padding: 8px 18px;
                border-radius: 10px;
                transition: all 0.2s;
            }
            .navbar-public .nav-link:hover {
                background: var(--primary-light);
                color: var(--primary);
            }
            .navbar-public .nav-link i {
                margin-right: 6px;
            }

            /* ===== HERO SECTION ===== */
            .hero-section {
                position: relative;
                min-height: 85vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #0d47a1 0%, #1a73e8 50%, #34a853 100%);
                overflow: hidden;
                padding: 120px 0 80px;
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.4;
            }
            .hero-section::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                right: 0;
                height: 120px;
                background: #f8fafc;
                clip-path: ellipse(70% 100% at 50% 100%);
            }
            .hero-content {
                position: relative;
                z-index: 2;
                text-align: center;
                color: white;
                max-width: 800px;
                padding: 0 20px;
            }
            .hero-badge {
                display: inline-block;
                background: rgba(255,255,255,0.15);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.2);
                padding: 6px 20px;
                border-radius: 50px;
                font-size: 0.85rem;
                font-weight: 500;
                margin-bottom: 24px;
                letter-spacing: 0.5px;
            }
            .hero-content h1 {
                font-size: 3.2rem;
                font-weight: 800;
                letter-spacing: -1px;
                line-height: 1.2;
                margin-bottom: 12px;
                text-shadow: 0 2px 20px rgba(0,0,0,0.15);
            }
            .hero-content p.subtitle {
                font-size: 1.2rem;
                opacity: 0.9;
                font-weight: 400;
                margin-bottom: 40px;
            }
            .hero-btn-group {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                justify-content: center;
            }
            .hero-btn-group .btn {
                padding: 14px 36px;
                border-radius: 14px;
                font-weight: 600;
                font-size: 1.05rem;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                min-width: 200px;
                justify-content: center;
            }
            .hero-btn-group .btn:hover {
                transform: translateY(-3px);
                box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            }
            .btn-hero-primary {
                background: white;
                color: var(--primary-dark);
                border: none;
            }
            .btn-hero-primary:hover {
                background: #f0f0f0;
                color: var(--primary-dark);
            }
            .btn-hero-secondary {
                background: rgba(255, 255, 255, 0.9);
                color: var(--primary-dark);
                border: 2px solid rgba(255,255,255,0.9);
            }
            .btn-hero-secondary:hover {
                background: white;
                border-color: white;
                color: var(--primary-dark);
            }

            /* ===== FLOATING DECORATION ===== */
            .float-shape {
                position: absolute;
                border-radius: 50%;
                background: rgba(255,255,255,0.06);
                pointer-events: none;
            }
            .float-shape-1 {
                width: 400px;
                height: 400px;
                top: -100px;
                right: -100px;
                animation: float 8s ease-in-out infinite;
            }
            .float-shape-2 {
                width: 300px;
                height: 300px;
                bottom: -50px;
                left: -80px;
                animation: float 10s ease-in-out infinite reverse;
            }
            .float-shape-3 {
                width: 150px;
                height: 150px;
                top: 30%;
                left: 10%;
                animation: float 6s ease-in-out infinite 2s;
            }
            @keyframes float {
                0%, 100% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(30px, -30px) scale(1.05); }
            }

            /* ===== PAGE CONTENT (for child views) ===== */
            .page-content-wrapper {
                min-height: 10vh;
                padding-top: 80px;
                padding-bottom: 60px;
            }

            /* ===== MODERN CARDS ===== */
            .card-modern {
                border: none;
                border-radius: 16px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
                transition: all 0.3s ease;
            }
            .card-modern:hover {
                box-shadow: 0 10px 30px rgba(0,0,0,0.08);
                transform: translateY(-2px);
            }
            .card-modern .card-body {
                padding: 24px;
            }

            /* ===== SECTION TITLES ===== */
            .section-title {
                font-weight: 700;
                font-size: 1.75rem;
                color: var(--dark);
                margin-bottom: 8px;
            }
            .section-subtitle {
                color: var(--gray);
                font-size: 1rem;
                margin-bottom: 32px;
            }

            /* ===== SERVICE CARDS ===== */
            .service-card {
                background: white;
                border: none;
                border-radius: 16px;
                padding: 28px 20px;
                text-align: center;
                box-shadow: 0 1px 3px rgba(0,0,0,0.06);
                transition: all 0.3s ease;
                cursor: pointer;
                text-decoration: none;
                color: var(--dark);
                display: block;
                height: 100%;
            }
            .service-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 16px 40px rgba(26, 115, 232, 0.12);
                color: var(--primary);
                text-decoration: none;
            }
            .service-card .icon-circle {
                width: 64px;
                height: 64px;
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 16px;
                font-size: 1.6rem;
                color: white;
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            }
            .service-card h5 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 4px;
            }
            .service-card p {
                font-size: 0.85rem;
                color: var(--gray);
                margin: 0;
            }

            /* ===== FOOTER ===== */
            .footer-public {
                background: var(--dark);
                color: rgba(255,255,255,0.7);
                padding: 40px 0 24px;
            }
            .footer-public h5 {
                color: white;
                font-weight: 700;
                font-size: 1rem;
                margin-bottom: 16px;
            }
            .footer-public a {
                color: rgba(255,255,255,0.7);
                text-decoration: none;
                transition: color 0.2s;
                display: block;
                margin-bottom: 8px;
                font-size: 0.9rem;
            }
            .footer-public a:hover {
                color: white;
            }
            .footer-public .footer-bottom {
                border-top: 1px solid rgba(255,255,255,0.1);
                padding-top: 20px;
                margin-top: 32px;
                font-size: 0.85rem;
                text-align: center;
            }
            .footer-public .social-links a {
                display: inline-flex;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: rgba(255,255,255,0.1);
                align-items: center;
                justify-content: center;
                margin-right: 8px;
                transition: all 0.3s;
                font-size: 1rem;
            }
            .footer-public .social-links a:hover {
                background: var(--primary);
                color: white;
                transform: translateY(-2px);
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 768px) {
                .hero-content h1 {
                    font-size: 2rem;
                }
                .hero-content p.subtitle {
                    font-size: 1rem;
                }
                .hero-btn-group .btn {
                    min-width: 160px;
                    padding: 12px 24px;
                    font-size: 0.95rem;
                }
                .hero-section {
                    min-height: 70vh;
                    padding: 100px 0 60px;
                }
                .navbar-public .navbar-brand {
                    font-size: 1.2rem;
                }
            }
            @media (max-width: 576px) {
                .hero-content h1 {
                    font-size: 1.6rem;
                }
                .hero-btn-group .btn {
                    min-width: 100%;
                }
            }

            /* ===== ANIMATIONS ===== */
            .fade-in-up {
                animation: fadeInUp 0.6s ease forwards;
                opacity: 0;
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .delay-1 { animation-delay: 0.1s; }
            .delay-2 { animation-delay: 0.2s; }
            .delay-3 { animation-delay: 0.3s; }
            .delay-4 { animation-delay: 0.4s; }
        </style>
    </head>

    <body>

        <!-- ===== NAVBAR ===== -->
        <nav class="navbar navbar-expand-lg navbar-public fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <i class="fas fa-city me-2"></i>Kelurahan <span>Kebonsari</span>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
                    <i class="fas fa-bars" style="font-size: 1.4rem; color: var(--dark);"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarPublic">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-handshake"></i>Pelayanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.informasi_umum') }}"><i class="fas fa-info-circle"></i>Informasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- ===== HERO SECTION (only on index page) ===== -->
        @if (Route::current()->getName() == 'index')
            <!-- Modal Pelayanan -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                        <div class="modal-header border-0" style="background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 16px 16px 0 0;">
                            <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">
                                <i class="fas fa-handshake me-2"></i>Data Diri
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('web.layanan.index') }}" method="POST">
                            @csrf
                            <div class="modal-body p-4">
                                <p class="text-muted mb-4">Silakan masukkan data diri Anda untuk mengakses layanan.</p>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold"><i class="fas fa-user text-primary me-2"></i>Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-lg" name="nama" placeholder="Masukkan nama Anda" required style="border-radius: 12px;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold"><i class="fas fa-map-marker-alt text-primary me-2"></i>Alamat</label>
                                    <input type="text" class="form-control form-control-lg" name="alamat" placeholder="Masukkan alamat Anda" required style="border-radius: 12px;">
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 12px;">Tutup</button>
                                <button type="submit" class="btn btn-primary px-4" style="border-radius: 12px;">
                                    <i class="fas fa-arrow-right me-2"></i>Lanjutkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hero -->
            <section class="hero-section">
                <div class="float-shape float-shape-1"></div>
                <div class="float-shape float-shape-2"></div>
                <div class="float-shape float-shape-3"></div>
                <div class="hero-content">
                    <div class="hero-badge fade-in-up">
                        <i class="fas fa-city me-2"></i>Pemerintah Kota Surabaya
                    </div>
                    <h1 class="fade-in-up delay-1">Kelurahan Kebonsari</h1>
                    <p class="subtitle fade-in-up delay-2">Melayani masyarakat dengan sepenuh hati untuk Surabaya yang lebih baik</p>
                    <div class="hero-btn-group fade-in-up delay-3">
                        <button type="button" class="btn btn-hero-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-handshake"></i>Akses Pelayanan
                        </button>
                        <a href="{{ route('web.informasi_umum') }}" class="btn btn-hero-secondary">
                            <i class="fas fa-info-circle"></i>Informasi Umum
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- ===== CONTENT FROM CHILD VIEWS ===== -->
        <div class="page-content-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <!-- ===== FOOTER ===== -->
        <footer class="footer-public">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h5><i class="fas fa-city me-2"></i>Kelurahan Kebonsari</h5>
                        <p style="font-size: 0.9rem;">Melayani masyarakat Kelurahan Kebonsari, Kecamatan Sukolilo, Kota Surabaya dengan integritas dan profesionalisme.</p>
                        <div class="social-links mt-3">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5>Links Cepat</h5>
                        <a href="{{ route('index') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Beranda</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Pelayanan</a>
                        <a href="{{ route('web.informasi_umum') }}"><i class="fas fa-chevron-right me-2" style="font-size: 0.6rem;"></i>Informasi Umum</a>
                    </div>
                    <div class="col-lg-4">
                        <h5>Kontak</h5>
                        <a href="#"><i class="fas fa-map-marker-alt me-2"></i>Kelurahan Kebonsari, Sukolilo, Surabaya</a>
                        <a href="#"><i class="fas fa-phone me-2"></i>(031) 1234-5678</a>
                        <a href="#"><i class="fas fa-envelope me-2"></i>kebonsari@surabaya.go.id</a>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; {{ date('Y') }} Kelurahan Kebonsari, Pemerintah Kota Surabaya. All rights reserved.
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        
        {{-- Search JS now handled in each child view --}}
    </body>

    </html>
