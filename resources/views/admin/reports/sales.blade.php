@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')
<style>
    /* Konsistensi Tema Premium */
    .report-card {
        transition: all 0.3s ease;
        border: none !important;
        border-radius: 15px;
    }
    .filter-card {
        background: #f8f9fa;
        border-radius: 15px;
        border: 1px solid #e9ecef;
    }
    .icon-shape {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
    .table thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        font-weight: 700;
        color: #6c757d;
        border: none;
    }
    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }
    .badge-soft-success { background-color: #d1e7dd; color: #0f5132; }
    .badge-soft-primary { background-color: #cfe2ff; color: #084298; }
</style>

<div class="container-fluid py-4">
    {{-- Header & Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Laporan Penjualan</h2>
            <p class="text-muted small mb-0">Pantau performa bisnis dan ekspor data transaksi</p>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="card report-card shadow-sm mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-uppercase text-muted">Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ $dateFrom }}" class="form-control border-0 shadow-sm" style="background: #f1f3f5;">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-uppercase text-muted">Sampai Tanggal</label>
                    <input type="date" name="date_to" value="{{ $dateTo }}" class="form-control border-0 shadow-sm" style="background: #f1f3f5;">
                </div>
                <div class="col-md-6 d-flex gap-2 justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                        <i class="bi bi-filter-right me-1"></i> Filter Data
                    </button>
                    <a href="{{ route('admin.reports.export-sales', request()->all()) }}" class="btn btn-success px-4 rounded-pill shadow-sm">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card report-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-success bg-opacity-10 text-success me-3">
                            <i class="bi bi-wallet2 fs-5"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Total Pendapatan</p>
                    </div>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($summary->total_revenue ?? 0, 0, ',', '.') }}</h3>
                    <div class="mt-2 small text-muted">Periode terpilih</div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card report-card shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-shape bg-primary bg-opacity-10 text-primary me-3">
                            <i class="bi bi-cart-check fs-5"></i>
                        </div>
                        <p class="text-muted mb-0 small fw-bold text-uppercase">Total Transaksi</p>
                    </div>
                    <h3 class="fw-bold mb-0">{{ number_format($summary->total_orders ?? 0) }}</h3>
                    <div class="mt-2 small text-muted">Pesanan Berhasil</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Sales By Category --}}
        <div class="col-lg-4">
            <div class="card report-card shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <h5 class="fw-bold">Performa Kategori</h5>
                </div>
                <div class="card-body px-4">
                    @foreach($byCategory as $cat)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-semibold text-dark">{{ $cat->name }}</span>
                                <span class="text-primary fw-bold small">Rp {{ number_format($cat->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                @php 
                                    $percentage = ($summary->total_revenue > 0) ? ($cat->total / $summary->total_revenue) * 100 : 0;
                                @endphp
                                <div class="progress-bar bg-primary rounded-pill" role="progressbar"
                                     style="width: {{ $percentage }}%">
                                </div>
                            </div>
                            <div class="text-end mt-1">
                                <small class="text-muted" style="font-size: 0.7rem">{{ number_format($percentage, 1) }}% kontribusi</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Transactions Table --}}
        <div class="col-lg-8">
            <div class="card report-card shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Rincian Transaksi</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Order ID</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th class="text-end pe-4">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="ps-4">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="fw-bold text-primary text-decoration-none">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="small text-dark">{{ $order->created_at->format('d M Y') }}</div>
                                            <div class="text-muted small" style="font-size: 0.75rem">{{ $order->created_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold small text-dark">{{ $order->user->name }}</div>
                                            <div class="text-muted small" style="font-size: 0.75rem">{{ $order->user->email }}</div>
                                        </td>
                                        <td class="text-end pe-4 fw-bold text-dark">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" class="opacity-25 mb-3">
                                            <p class="text-muted small">Tidak ada data penjualan pada periode ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 py-3 px-4 d-flex justify-content-end">
                    <div class="pagination-wrapper">
                        {{ $orders->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection