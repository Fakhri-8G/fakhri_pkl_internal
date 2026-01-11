@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        {{-- SIDEBAR FILTER --}}
        <div class="col-lg-3">
            <div class="filter-section">
                <div class="card border-0 shadow-sm p-3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Filter Produk</h5>
                        
                        <form action="{{ route('catalog.index') }}" method="GET">
                            @if(request('q')) 
                                <input type="hidden" name="q" value="{{ request('q') }}"> 
                            @endif

                            {{-- Filter Kategori --}}
                            <div class="mb-4">
                                <label class="text-uppercase small fw-bold text-muted mb-3 d-block">Kategori</label>
                                @foreach($categories as $cat)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="category" 
                                            id="cat-{{ $cat->slug }}" value="{{ $cat->slug }}"
                                            {{ request('category') == $cat->slug ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="cat-{{ $cat->slug }}">
                                            <span>{{ $cat->name }}</span>
                                            <span class="badge rounded-pill bg-light text-dark border">{{ $cat->products_count }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            {{-- Filter Harga --}}
                            <div class="mb-4">
                                <label class="text-uppercase small fw-bold text-muted mb-3 d-block">Rentang Harga</label>
                                <div class="input-group input-group-sm mb-2">
                                    <span class="input-group-text bg-white">Rp</span>
                                    <input type="number" name="min_price" class="form-control price-input" placeholder="Minimum" value="{{ request('min_price') }}">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text bg-white">Rp</span>
                                    <input type="number" name="max_price" class="form-control price-input" placeholder="Maksimum" value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-3 fw-bold shadow-sm">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('catalog.index') }}" class="btn btn-link w-100 btn-sm mt-2 text-muted text-decoration-none">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="col-lg-9">
            {{-- Header & Sorting --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1">Katalog Produk</h3>
                    <p class="text-muted small mb-0">Menampilkan {{ $products->count() }} produk terbaik untuk Anda</p>
                </div>
                
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small text-nowrap">Urutkan:</span>
                    <form method="GET" id="sortForm">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" class="form-select form-select-sm border-0 shadow-sm" style="min-width: 150px;" onchange="this.form.submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>✨ Terbaru</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>💰 Harga Terendah</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>📈 Harga Tertinggi</option>
                        </select>
                    </form>
                </div>
            </div>

            {{-- Products --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-4">
                @forelse($products as $product)
                    <div class="col">
                        {{-- Membungkus komponen card agar punya efek hover seragam --}}
                        <div class="h-100 product-card shadow-sm bg-white border">
                            <x-product-card :product="$product" />
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 bg-white rounded-3 shadow-sm border">
                            <img src="{{ asset('assets/images/empty/no-image.png') }}" width="90">
                            <h4 class="fw-bold">Yah, Produk Tidak Ada</h4>
                            <p class="text-muted">Coba gunakan filter <br> yang berbeda atau hapus pencarian.</p>
                            <a href="{{ route('catalog.index') }}" class="btn btn-primary px-4">Lihat Semua Produk</a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .filter-section {
        position: sticky;
        top: 20px;
    }
    .category-link {
        text-decoration: none;
        color: #495057;
        transition: 0.2s;
    }
    .category-link:hover {
        color: #0d6efd;
    }
    .price-input {
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
</style>
@endsection