@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Custom Styling untuk Tampilan Premium */
    .dashboard-card {
        transition: all 0.3s ease;
        border: none !important;
        border-radius: 15px;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }
    .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
    }
    .badge-soft-success { background-color: #d1e7dd; color: #0f5132; }
    .badge-soft-warning { background-color: #fff3cd; color: #664d03; }
    .badge-soft-danger { background-color: #f8d7da; color: #842029; }
    .badge-soft-primary { background-color: #cfe2ff; color: #084298; }
</style>

<div class="container-fluid py-4">
    {{-- 1. Stats Cards Grid --}}
    <div class="row g-4 mb-4">
        {{-- Revenue Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-success bg-opacity-10 text-success me-3">
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Total Pendapatan</p>
                    </div>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        {{-- Pending Action Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-warning bg-opacity-10 text-warning me-3">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Perlu Diproses</p>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $stats['pending_orders'] }}</h3>
                </div>
            </div>
        </div>

        {{-- Low Stock Card --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-danger bg-opacity-10 text-danger me-3">
                            <i class="bi bi-exclamation-circle fs-4"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Stok Menipis</p>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $stats['low_stock'] }}</h3>
                </div>
            </div>
        </div>

        {{-- Total Products --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Total Produk</p>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $stats['total_products'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- 2. Revenue Chart --}}
        <div class="col-lg-8">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold">Analitik Penjualan</h5>
                    <p class="text-muted small">Statistik pendapatan 7 hari terakhir</p>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Recent Orders --}}
        <div class="col-lg-4">
            <div class="card dashboard-card shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Pesanan Baru</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light text-primary fw-bold">Lihat Semua</a>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-borderless">
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">#{{ $order->order_number }}</div>
                                        <div class="text-muted small">{{ $order->user->name }}</div>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="fw-bold small">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <span class="badge {{ $order->payment_status == 'paid' ? 'badge-soft-success' : 'badge-soft-primary' }} rounded-pill" style="font-size: 0.7rem">
                                            {{ strtoupper($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 4. Top Selling Products --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card dashboard-card shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold">Produk Terlaris</h5>
                </div>
                <div class="card-body px-4">
                    <div class="row g-4 pb-3">
                        @foreach($topProducts as $product)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="text-center p-3 border rounded-4 transition hover-shadow h-100">
                                    <img src="{{ $product->image_url }}" class="product-img mb-2 shadow-sm">
                                    <h6 class="text-truncate mb-1" title="{{ $product->name }}" style="font-size: 0.85rem">{{ $product->name }}</h6>
                                    <span class="badge badge-soft-primary">{{ $product->sold }} Terjual</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Gradient Background untuk Chart
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
    gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart->pluck('date')) !!},
            datasets: [{
                label: 'Pendapatan',
                data: {!! json_encode($revenueChart->pluck('total')) !!},
                borderColor: '#0d6efd',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#0d6efd',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    grid: { display: true, drawBorder: false, color: '#f0f0f0' },
                    ticks: { 
                        callback: value => 'Rp ' + new Intl.NumberFormat('id-ID', { notation: "compact" }).format(value)
                    }
                },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection