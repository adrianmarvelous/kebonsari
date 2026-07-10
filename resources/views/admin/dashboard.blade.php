<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Admin - Kelurahan Kebonsari</title>
    <link rel="icon" href="{{ asset('templetes/kaiadmin-lite/assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        * {
            font-family: 'Inter', 'Poppins', sans-serif;
        }

        body {
            background: #f0f2f5;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #0d47a1 0%, #1a73e8 100%);
            z-index: 1040;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 20px rgba(0,0,0,0.1);
        }
        .admin-sidebar .sidebar-header {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: var(--header-height);
        }
        .admin-sidebar .sidebar-header .brand {
            color: white;
            font-weight: 800;
            font-size: 1.2rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-sidebar .sidebar-header .brand i {
            font-size: 1.5rem;
        }
        .admin-sidebar .sidebar-header .brand span {
            color: rgba(255,255,255,0.8);
        }
        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .sidebar-toggle-btn:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .admin-sidebar .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
        }
        .admin-sidebar .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }
        .admin-sidebar .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 4px;
        }
        .admin-sidebar .menu-label {
            color: rgba(255,255,255,0.4);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            padding: 16px 12px 8px;
        }
        .admin-sidebar .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s;
            margin-bottom: 2px;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .admin-sidebar .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .admin-sidebar .menu-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
            font-weight: 600;
        }
        .admin-sidebar .menu-item i {
            width: 22px;
            text-align: center;
            font-size: 1.1rem;
        }
        .admin-sidebar .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .admin-sidebar .sidebar-footer .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 14px;
            border-radius: 10px;
            transition: all 0.2s;
            cursor: pointer;
            color: rgba(255,255,255,0.8);
        }
        .admin-sidebar .sidebar-footer .user-info:hover {
            background: rgba(255,255,255,0.1);
        }
        .admin-sidebar .sidebar-footer .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
        }
        .admin-sidebar .sidebar-footer .user-details {
            flex: 1;
            min-width: 0;
        }
        .admin-sidebar .sidebar-footer .user-details .name {
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .admin-sidebar .sidebar-footer .user-details .role {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }
        .admin-main .top-navbar {
            background: white;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        .admin-main .top-navbar .page-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--dark);
        }
        .admin-main .top-navbar .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .admin-main .top-navbar .navbar-right .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            text-decoration: none;
            transition: all 0.2s;
            font-size: 1.1rem;
            position: relative;
        }
        .admin-main .top-navbar .navbar-right .nav-icon:hover {
            background: var(--primary-light);
            color: var(--primary);
        }
        .admin-main .top-navbar .navbar-right .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px 6px 6px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--dark);
        }
        .admin-main .top-navbar .navbar-right .user-dropdown:hover {
            background: var(--light-gray);
        }
        .admin-main .top-navbar .navbar-right .user-dropdown .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .admin-content {
            padding: 24px 30px;
        }

        /* ===== MODERN CARDS ===== */
        .card-modern {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card-modern:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .card-modern .card-header-custom {
            padding: 20px 24px 0;
            border: none;
        }
        .card-modern .card-header-custom h5 {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }
        .card-modern .card-body-custom {
            padding: 20px 24px 24px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        }
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .stat-card .stat-icon.blue {
            background: var(--primary-light);
            color: var(--primary);
        }
        .stat-card .stat-icon.green {
            background: var(--accent-light);
            color: var(--accent);
        }
        .stat-card .stat-icon.orange {
            background: #fff3e0;
            color: #f57c00;
        }
        .stat-card .stat-icon.purple {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        .stat-card .stat-info {
            flex: 1;
        }
        .stat-card .stat-info .stat-number {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
        }
        .stat-card .stat-info .stat-label {
            font-size: 0.85rem;
            color: var(--gray);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ===== TABLES ===== */
        .table-admin {
            margin-bottom: 0;
        }
        .table-admin thead th {
            background: var(--light-gray);
            color: var(--dark);
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
            border-bottom: none;
        }
        .table-admin tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: 0.9rem;
            border-color: #f0f0f0;
        }
        .table-admin tbody tr:hover {
            background: #f8faff;
        }

        /* ===== BUTTONS ===== */
        .btn-admin {
            padding: 8px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-admin:hover {
            transform: translateY(-1px);
        }
        .btn-admin-primary {
            background: var(--primary);
            color: white;
        }
        .btn-admin-primary:hover {
            background: var(--primary-dark);
            color: white;
        }
        .btn-admin-success {
            background: var(--accent);
            color: white;
        }
        .btn-admin-success:hover {
            background: #2d8f47;
            color: white;
        }
        .btn-admin-danger {
            background: var(--danger-color);
            color: white;
        }
        .btn-admin-danger:hover {
            background: #d33426;
            color: white;
        }
        .btn-admin-warning {
            background: var(--warning-color);
            color: #333;
        }
        .btn-admin-warning:hover {
            background: #e5a800;
            color: #333;
        }
        .btn-admin-info {
            background: #17a2b8;
            color: white;
        }
        .btn-admin-info:hover {
            background: #138496;
            color: white;
        }
        .btn-admin-sm {
            padding: 6px 14px;
            font-size: 0.8rem;
        }

        /* ===== ALERTS ===== */
        .alert-modern {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 0.9rem;
        }
        .alert-modern.alert-success {
            background: var(--accent-light);
            color: #1e7e34;
        }
        .alert-modern.alert-danger {
            background: #fce4e4;
            color: var(--danger-color);
        }

        /* ===== FORMS ===== */
        .form-control-modern {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }
        .form-label-modern {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--dark);
            margin-bottom: 6px;
        }

        /* ===== MODAL ===== */
        .modal-modern .modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .modal-modern .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 16px 16px 0 0;
            padding: 20px 24px;
            border: none;
        }
        .modal-modern .modal-header .modal-title {
            color: white;
            font-weight: 700;
        }
        .modal-modern .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        .modal-modern .modal-body {
            padding: 24px;
        }
        .modal-modern .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #f0f0f0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .admin-content {
                padding: 16px;
            }
            .admin-main .top-navbar {
                padding: 0 16px;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1035;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
        @media (min-width: 769px) {
            .sidebar-overlay {
                display: none !important;
            }
            .mobile-toggle {
                display: none !important;
            }
        }

        /* ===== ANIMATIONS ===== */
        .fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Chart container */
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* DataTables custom */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e5e7eb !important;
            border-radius: 10px !important;
            padding: 6px 12px !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px var(--primary-light) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===== SIDEBAR ===== -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="brand">
                <i class="fas fa-city"></i>
                Admin <span>Panel</span>
            </a>
            <button class="sidebar-toggle-btn d-none d-md-block" id="sidebarCollapse">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="sidebar-toggle-btn d-md-none" id="sidebarClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sidebar-menu">
            <div class="menu-label">Menu</div>

            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>

            @foreach ($menus as $menu)
            <a href="{{ route($menu->url) }}" class="menu-item {{ request()->routeIs(str_replace('.index', '.*', $menu->url)) ? 'active' : '' }}">
                <i class="fas fa-{{ $menu->icon }}"></i>
                <span>{{ $menu->name }}</span>
            </a>
            @endforeach
        </div>

        <div class="sidebar-footer">
            <div class="user-info" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <div class="name">{{ session('nama') }}</div>
                    <div class="role">{{ session('role') }}</div>
                </div>
                <i class="fas fa-sign-out-alt" style="font-size: 0.9rem; opacity: 0.6;"></i>
            </div>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="admin-main">
        <!-- Top Navbar -->
        <nav class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle-btn mobile-toggle d-md-none" id="sidebarOpen" style="color: var(--dark);">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="page-title">
                    @if (request()->routeIs('dashboard'))
                        Dashboard
                    @elseif (request()->routeIs('users.*'))
                        Manajemen User
                    @elseif (request()->routeIs('layanan.*'))
                        Layanan
                    @elseif (request()->routeIs('info.*'))
                        Info
                    @elseif (request()->routeIs('pengunjung.*'))
                        Pengunjung
                    @elseif (request()->routeIs('agenda.*'))
                        Agenda
                    @else
                        Admin Panel
                    @endif
                </span>
            </div>
            <div class="navbar-right">
                <a href="{{ route('index') }}" target="_blank" class="nav-icon" title="Lihat Website">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <div class="dropdown">
                    <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar">
                            {{ substr(session('nama', 'A'), 0, 1) }}
                        </div>
                        <span class="d-none d-md-inline fw-semibold" style="font-size: 0.9rem;">{{ session('nama') }}</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.7rem; color: var(--gray);"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="border: none; border-radius: 12px; padding: 8px;">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                @csrf
                                <a class="dropdown-item py-2 px-3" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    style="border-radius: 8px; color: var(--danger-color);">
                                    <i class="fas fa-sign-out-alt me-2"></i> Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <div class="admin-content">
            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="alert alert-modern alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <strong>Terjadi kesalahan!</strong>
                    </div>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @foreach (['success' => 'check-circle', 'error' => 'exclamation-circle'] as $type => $icon)
                @if (session($type))
                    <div class="alert alert-modern alert-{{ $type == 'error' ? 'danger' : 'success' }} alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-{{ $icon }}"></i>
                            <span>{{ session($type) }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

            @if (Route::current()->getName() == 'dashboard')
                <!-- Dashboard Stats -->
                <div class="row g-4 mb-4 fade-in-up">
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon blue">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-number">{{ $totalUsers ?? 0 }}</div>
                                <div class="stat-label">Total User</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon green">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-number">{{ $totalLayanan ?? 0 }}</div>
                                <div class="stat-label">Total Layanan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon orange">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-number">{{ $totalAgenda ?? 0 }}</div>
                                <div class="stat-label">Total Agenda</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon purple">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="stat-info">
                                <div class="stat-number">{{ $totalPengunjung ?? 0 }}</div>
                                <div class="stat-label">Total Pengunjung</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row g-4 mb-4 fade-in-up">
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-custom">
                                <h5><i class="fas fa-chart-line text-primary me-2"></i>Pengunjung 6 Bulan Terakhir</h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="chart-container">
                                    <canvas id="chartBulanan"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-custom">
                                <h5><i class="fas fa-chart-pie text-primary me-2"></i>Layanan per Kategori</h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="chart-container">
                                    <canvas id="chartKategori"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4 fade-in-up">
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-custom">
                                <h5><i class="fas fa-chart-bar text-primary me-2"></i>Layanan Terpopuler</h5>
                            </div>
                            <div class="card-body-custom">
                                <div class="chart-container" style="height: 280px;">
                                    <canvas id="chartLayananPopuler"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-custom d-flex justify-content-between align-items-center">
                                <h5><i class="fas fa-user-check text-primary me-2"></i>Pengunjung Terbaru</h5>
                                @if(isset($latestVisitors) && count($latestVisitors) > 0)
                                    <a href="{{ route('pengunjung.index') }}" class="btn btn-admin btn-admin-primary btn-admin-sm">Lihat Semua</a>
                                @endif
                            </div>
                            <div class="card-body-custom">
                                @if(isset($latestVisitors) && count($latestVisitors) > 0)
                                    <div class="table-responsive" style="max-height: 260px;">
                                        <table class="table table-admin">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Layanan</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($latestVisitors as $visitor)
                                                    <tr>
                                                        <td class="fw-semibold">{{ $visitor->nama }}</td>
                                                        <td>{{ $visitor->layanan->nama_layanan ?? '-' }}</td>
                                                        <td>{{ date('d M Y', strtotime($visitor->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted text-center py-3 mb-0">Belum ada data pengunjung.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 fade-in-up">
                    <div class="col-lg-12">
                        <div class="card-modern">
                            <div class="card-header-custom d-flex justify-content-between align-items-center">
                                <h5><i class="fas fa-calendar-alt text-primary me-2"></i>Agenda Terbaru</h5>
                                @if(isset($latestAgendas) && count($latestAgendas) > 0)
                                    <a href="{{ route('agenda.index') }}" class="btn btn-admin btn-admin-primary btn-admin-sm">Lihat Semua</a>
                                @endif
                            </div>
                            <div class="card-body-custom">
                                @if(isset($latestAgendas) && count($latestAgendas) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-admin">
                                            <thead>
                                                <tr>
                                                    <th>Nama Agenda</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($latestAgendas as $agenda)
                                                    <tr>
                                                        <td class="fw-semibold">{{ $agenda->nama_agenda }}</td>
                                                        <td>{{ date('d M Y', strtotime($agenda->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted text-center py-3 mb-0">Belum ada data agenda.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarOpen')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.add('show');
            document.getElementById('sidebarOverlay').classList.add('show');
        });
        document.getElementById('sidebarClose')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
        document.getElementById('sidebarOverlay')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });

        // ── Inisialisasi Chart ──
        function initCharts() {
            // 1. Chart Pengunjung Bulanan (Line)
            const ctx1 = document.getElementById('chartBulanan')?.getContext('2d');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($bulanLabels ?? []) !!},
                        datasets: [{
                            label: 'Pengunjung',
                            data: {!! json_encode($bulanData ?? []) !!},
                            borderColor: '#1a73e8',
                            backgroundColor: 'rgba(26,115,232,0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#1a73e8',
                            pointRadius: 4,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // 2. Chart Kategori Layanan (Doughnut)
            const ctx2 = document.getElementById('chartKategori')?.getContext('2d');
            if (ctx2) {
                const colors = ['#1a73e8', '#34a853', '#fbbc04', '#ea4335', '#7b1fa2', '#f57c00'];
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($kategoriLabelArr ?? []) !!},
                        datasets: [{
                            data: {!! json_encode($kategoriDataArr ?? []) !!},
                            backgroundColor: colors,
                            borderWidth: 0,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { padding: 16, usePointStyle: true }
                            }
                        }
                    }
                });
            }

            // 3. Chart Layanan Terpopuler (Bar)
            const ctx3 = document.getElementById('chartLayananPopuler')?.getContext('2d');
            if (ctx3) {
                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($layananLabelArr ?? []) !!},
                        datasets: [{
                            label: 'Jumlah',
                            data: {!! json_encode($layananDataArr ?? []) !!},
                            backgroundColor: ['#1a73e8', '#34a853', '#fbbc04', '#ea4335', '#7b1fa2'],
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                            y: { grid: { display: false } }
                        }
                    }
                });
            }
        }

        // Run charts on page load
        initCharts();

        // Initialize Summernote
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        // Initialize DataTables
        $(document).ready(function() {
            $('.table-datatable').each(function() {
                if (!$.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable({
                        language: {
                            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                        }
                    });
                }
            });
        });

        // Auto-hide alerts
        setTimeout(function() {
            document.querySelectorAll('.alert-modern').forEach(function(el) {
                let bsAlert = new bootstrap.Alert(el);
                setTimeout(() => bsAlert.close(), 4000);
            });
        }, 5000);
    </script>
</body>
</html>

