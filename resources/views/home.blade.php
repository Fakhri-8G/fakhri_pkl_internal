{{-- ================================================
     FILE: resources/views/home.blade.php
     FUNGSI: Halaman utama website Toko Seragam Sekolah
     ================================================ --}}

@extends('layouts.app')

@section('title', 'Beranda - Pusat Seragam Sekolah Berkualitas')

@section('content')
    {{-- Hero Section: Bertema Pendidikan --}}
    <section class="bg-primary text-white py-5" style="background: linear-gradient(45deg, #163f77, #1c88fc);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">
                        Siap Kembali ke Sekolah dengan Rapi
                    </h1>
                    <p class="lead mb-4">
                        Menyediakan seragam SMK dengan bahan berkualitas, nyaman dipakai, dan tahan lama.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('catalog.index') }}" class="btn btn-light btn-lg text-primary fw-bold">
                            <i class="bi bi-cart-check me-2"></i>Belanja Sekarang
                        </a>
                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-light btn-lg">
                            Lihat Katalog
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    {{-- Ganti image-hero dengan ilustrasi siswa sekolah --}}
                    <a href="{{ route('catalog.index', ['on_sale' => 1]) }}" title="Lihat Produk Diskon">
                        <img src="{{ asset('assets/images/on-sale2.png') }}" 
                            alt="Seragam Sekolah" class="img-fluid" style="max-height: 450px; filter: drop-shadow(5px 5px 15px rgba(0,0,0,0.2));">
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Info Keunggulan --}}
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <i class="bi bi-patch-check text-primary fs-2"></i>
                    <h5 class="mt-2">Bahan Standar Nasional</h5>
                    <p class="small text-muted">Nyaman, tidak panas, dan warna tidak mudah pudar.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-scissors text-primary fs-2"></i>
                    <h5 class="mt-2">Jahitan Rapi & Kuat</h5>
                    <p class="small text-muted">Dikerjakan oleh penjahit profesional berpengalaman.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-truck text-primary fs-2"></i>
                    <h5 class="mt-2">Pengiriman Cepat</h5>
                    <p class="small text-muted">Siap kirim ke seluruh sekolah di Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section id="kategori" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Pilih Seragam Sekolah</h2>
            <div class="row g-4 justify-content-center">
                @foreach($categories as $category)
                    <div class="col-6 col-md-3">
                        <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" 
                           class="text-decoration-none">
                            <div class="card border-0 shadow-sm text-center h-100 py-3 hover-shadow">
                                <div class="card-body">
                                    <img src="{{ $category->image_url }}" 
                                         alt="{{ $category->name }}" 
                                         class="mb-3"
                                         width="100" height="100" 
                                         style="object-fit: contain;">
                                    <h5 class="card-title mb-0 text-dark fw-bold">{{ $category->name }}</h5>
                                    <small class="text-primary">{{ $category->products_count }} Produk</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Paket Seragam Lengkap (Featured) --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0 fw-bold">Produk Populer</h2>
                    <p class="text-muted">Setelan lengkap baju, celana/rok, dan atribut.</p>
                </div>
                <a href="{{ route('catalog.index', ['filter' => 'paket-hemat']) }}" class="btn btn-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Promo & Custom Order --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card bg-danger text-white border-0 overflow-hidden shadow" style="min-height: 220px;">
                        <div class="card-body d-flex flex-column justify-content-center p-4">
                            <div class="z-1">
                                <span class="badge bg-white text-danger mb-2">Terbatas!</span>
                                <h3>Promo 20% Back to School</h3>
                                <p>Beli 2 setel seragam gratis sabuk sekolah.</p>
                                <a href="#" class="btn btn-light fw-bold px-4">Ambil Promo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-dark text-white border-0 overflow-hidden shadow" style="min-height: 220px;">
                        <div class="card-body d-flex flex-column justify-content-center p-4">
                            <div class="z-1">
                                <h3>Pesanan Grosir / Almamater?</h3>
                                <p>Terima pesanan khusus seragam batik dan jas almamater untuk sekolah.</p>
                                <a href="https://wa.me/your-number" class="btn btn-success fw-bold px-4">
                                    <i class="bi bi-whatsapp me-2"></i>Hubungi Admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Aksesoris & Atribut --}}
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Produk Terbaru</h2>
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        @include('partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>