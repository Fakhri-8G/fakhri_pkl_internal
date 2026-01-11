@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            {{-- Header Ringkas --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted small">
                    <i class="bi bi-chevron-left"></i> Kembali
                </a>
                @php
                    $statusClasses = [
                        'pending' => 'bg-warning text-dark',
                        'processing' => 'bg-info text-white',
                        'completed' => 'bg-success text-white',
                        'cancelled' => 'bg-danger text-white',
                    ];
                    $badgeClass = $statusClasses[$order->status] ?? 'bg-secondary text-white';
                @endphp
                <span class="badge rounded-pill px-4 py-2 fs-6 {{ $badgeClass }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold mb-1">Pesanan #{{ $order->order_number }}</h4>
                <p class="text-muted small">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>

            {{-- Daftar Produk (Model List Lebih Simpel dari Tabel) --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach($order->items as $item)
                        <li class="list-group-item py-3 border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $item->product_name }}</h6>
                                    <small class="text-muted">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                                </div>
                                <span class="fw-bold text-dark">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row g-4">
                {{-- Alamat Pengiriman --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Alamat Pengiriman</label>
                            <p class="mb-1 fw-bold"><i class="bi bi-person-fill"></i> {{ $order->shipping_name }}</p>
                            <p class="mb-1 small text-muted"><i class="bi bi-telephone-fill"></i> {{ $order->shipping_phone }}</p>
                            <p class="mb-0 small text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                {{-- Ringkasan Biaya --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Ringkasan Biaya</label>
                            <div class="d-flex justify-content-between mb-1 small">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                            @if($order->shipping_cost > 0)
                                <div>
                                    <span colspan="3" class="text-end pt-4 border-0">Ongkos Kirim:</span>
                                    <span class="text-end pt-4 border-0">
                                        Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                            <hr class="my-2 opacity-25">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Bayar</span>
                                <span class="fw-bold text-primary fs-5">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            @if(isset($snapToken) && $order->status === 'pending')
                <div class="mt-5 text-center">
                    <button id="pay-button" class="btn btn-primary btn-lg w-100 py-3 shadow-sm rounded-3 fw-bold mb-3">
                        Bayar Sekarang 💳
                    </button>
                    <p class="text-muted x-small">Aman & Terenkripsi oleh Midtrans</p>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- Script Midtrans Tetap Sama Seperti Kode Anda Sebelumnya --}}
@if(isset($snapToken))
    @push('scripts')
        <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script type="text/javascript">
              document.addEventListener('DOMContentLoaded', function() {
                const payButton = document.getElementById('pay-button');

                if (payButton) {
                    payButton.addEventListener('click', function() {
                        payButton.disabled = true;
                        payButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';

                        window.snap.pay('{{ $snapToken }}', {
                            onSuccess: function(result) {
                                window.location.href = '{{ route("orders.success", $order) }}';
                            },
                            onPending: function(result) {
                                window.location.href = '{{ route("orders.pending", $order) }}';
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal! Silakan coba lagi.');
                                payButton.disabled = false;
                                payButton.innerHTML = '💳 Bayar Sekarang';
                            },
                            onClose: function() {
                                payButton.disabled = false;
                                payButton.innerHTML = '💳 Bayar Sekarang';
                            }
                        });
                    });
                }
            });
        </script>
    @endpush
@endif

<style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 12px; }
    .x-small { font-size: 0.75rem; }
    .list-group-item { border-bottom: 1px solid rgba(0,0,0,0.05) !important; }
    .list-group-item:last-child { border-bottom: 0 !important; }
</style>
@endsection