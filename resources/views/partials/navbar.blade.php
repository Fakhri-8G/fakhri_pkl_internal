{{-- ================================================
     FILE: resources/views/partials/navbar.blade.php
     FUNGSI: Navigation bar khusus Toko Seragam Sekolah
     ================================================ --}}

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        {{-- Logo & Brand sekolah --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="min-width: 200px;" title="Home">
            <div class="bg-primary text-white rounded-3 p-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div style="line-height: 1.2;">
                <span class="fw-bold text-primary d-block">SERAGAM</span>
                <small class="text-muted fw-normal" style="font-size: 0.7rem; display: block; white-space: nowrap;">Pusat Perlengkapan</small>
            </div>
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler border-0" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            {{-- Search Form --}}
            <form class="d-flex mx-auto mt-3 mt-lg-0" style="max-width: 400px; width: 100%;" 
                  action="{{ route('catalog.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="q" 
                           class="form-control bg-light border-0" 
                           placeholder="Cari seragam SMK..." 
                           value="{{ request('q') }}">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>

            {{-- Right Menu --}}
            <ul class="navbar-nav ms-auto align-items-center">
                {{-- Link Katalog --}}
                <li class="nav-item">
                    <a class="nav-link text-dark fw-medium" href="{{ route('catalog.index') }}" title="Katalog">Katalog Lengkap</a>
                </li>
                @auth
                    {{-- Wishlist --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative px-2" href="{{ route('wishlist.index') }}" title="Favorit">
                            <i class="bi bi-heart fs-5"></i>
                            @if(auth()->user()->wishlists()->count() > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem;">
                                    {{ auth()->user()->wishlists()->count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- Cart --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative px-2" href="{{ route('cart.index') }}" title="Keranjang Belanja">
                            <i class="bi bi-cart3 fs-5"></i>
                            @php
                                $cartCount = auth()->user()->cart?->items()->count() ?? 0;
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.55rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link d-flex align-items-center p-0" 
                           href="#" id="userDropdown" 
                           data-bs-toggle="dropdown"
                           title="Profil"
                           >
                            <img src="{{ auth()->user()->avatar_url }}" 
                                 class="rounded-circle border" 
                                 width="35" height="35" 
                                 alt="{{ auth()->user()->name }}"
                                 style="object-fit: cover;">
                                <span class="d-none d-lg-inline p-1">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2 text-muted"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="bi bi-clock-history me-2 text-muted"></i> Riwayat Pesanan
                                </a>
                            </li>
                            @if(auth()->user()->isAdmin())
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Admin Panel
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Guest Links --}}
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-primary px-4 fw-bold" href="{{ route('register') }}">
                            Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: all 0.3s ease;
    }
    .nav-link {
        font-size: 0.95rem;
    }
    .nav-link:hover {
        color: #0047ab !important;
    }
    .dropdown-item:active {
        background-color: #0047ab;
    }
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(0, 71, 171, 0.1);
        border-radius: 0.375rem;
    }
</style>