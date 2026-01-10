<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f7fe;
        }

        /* SIDEBAR FIXED STYLE */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1030; /* Pastikan lebih tinggi dari elemen lain */
            background: #7e90b8 !important;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column; /* Pastikan arahnya kolom */
        }

        .main-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            position: relative;
        }

        /* NAVIGATION STYLE */
        .sidebar .nav-link {
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 4px 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover {
            background: #f8fafc;
            color: #312885;
        }

        .sidebar .nav-link.active {
            background: #312885; /* Warna utama */
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(49, 40, 133, 0.25);
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #e3eeff;
            margin: 20px 28px 10px;
        }

        /* TOP NAVBAR STYLE */
        .top-navbar {
            background: #7e90b8;
            backdrop-filter: blur(10px); /* Efek kaca transparan */
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* USER PROFILE SECTION */
        .user-profile-box {
            background: #f8fafc;
            margin: 16px;
            padding: 12px;
            border-radius: 15px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <aside class="sidebar">
            {{-- Brand --}}
            <div class="p-4 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center text-dark">
                    <div class="bg-primary rounded-3 p-2 me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; background-color: #312885 !important;">
                        <i class="bi bi-shop text-white"></i>
                    </div>
                    <span class="fs-5 fw-bold tracking-tight">Admin<span class="text-primary" style="color: #312885 !important;">Panel</span></span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-grow-1 overflow-auto">
                <div class="nav-section-title">Main Menu</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid-1x2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="bi bi-folder2"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                            <i class="bi bi-cart3"></i> Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Pengguna
                        </a>
                    </li>

                    <div class="nav-section-title">Reports</div>
                    <li class="nav-item">
                        <a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                            <i class="bi bi-bar-chart-line"></i> Penjualan
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- User Info --}}
            <div class="user-profile-box mt-auto">
                <div class="d-flex align-items-center">
                    <img src="{{ auth()->user()->avatar_url }}" class="rounded-circle me-3 shadow-sm" width="40" height="40" style="object-fit: cover;">
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="small fw-bold text-dark text-truncate">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">Administrator</div>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main Content Wrapper --}}
        <div class="main-wrapper">
            {{-- Top Navbar --}}
            <header class="top-navbar py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">@yield('page-title', 'Overview')</h5>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-light border fw-semibold px-3 rounded-pill" target="_blank">
                        <i class="bi bi-eye me-1"></i> Preview Toko
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="ms-2">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger fw-semibold px-3 rounded-pill">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 pt-3">
                @include('partials.flash-messages')
            </div>

            {{-- Page Content --}}
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>