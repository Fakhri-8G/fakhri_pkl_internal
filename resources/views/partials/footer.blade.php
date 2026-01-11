{{-- ================================================
     FILE: resources/views/partials/footer.blade.php
     FUNGSI: Footer website Toko Seragam Sekolah
     ================================================ --}}

<footer class="bg-dark text-light pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4">
            {{-- Brand & Description --}}
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white mb-3 d-flex align-items-center">
                    <i class="bi bi-mortarboard-fill me-2 text-primary"></i>
                    <span class="fw-bold">SERAGAM<span class="text-primary">KU</span></span>
                </h5>
                <p class="text-secondary small">
                    Pusat penyedia seragam sekolah berkualitas nasional untuk jenjang SMK. 
                    Kami berkomitmen menyediakan pakaian sekolah yang nyaman, rapi, dan tahan lama untuk mendukung prestasi putra-putri Anda.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="text-secondary fs-5 hover-primary"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            {{-- Quick Links: Berdasarkan Jenjang --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3 fw-bold">Koleksi Seragam</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('catalog.index', ['category' => 'baju-batik']) }}" class="text-secondary text-decoration-none small hover-link">
                            Seragam Batik
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('catalog.index', ['category' => 'almamater']) }}" class="text-secondary text-decoration-none small hover-link">
                            Seragam Almamater
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('catalog.index', ['category' => 'kemeja-putih']) }}" class="text-secondary text-decoration-none small hover-link">
                            Seragam SMK
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('catalog.index', ['category' => 'seragam-pramuka']) }}" class="text-secondary text-decoration-none small hover-link">
                            Atribut Pramuka
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Help & Guide --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="text-white mb-3 fw-bold">Bantuan Pembeli</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none small hover-link text-warning">
                            <i class="bi bi-rulers me-1"></i> Panduan Ukuran
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none small hover-link">Cara Pemesanan</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none small hover-link">Kebijakan Retur</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-secondary text-decoration-none small hover-link">Pengiriman Grosir</a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-lg-4 col-md-6">
                <h6 class="text-white mb-3 fw-bold">Lokasi Toko</h6>
                <ul class="list-unstyled text-secondary small">
                    <li class="mb-3 d-flex">
                        <i class="bi bi-geo-alt me-3 text-primary"></i>
                        <span>Jl. Pendidikan No. 45, Area Pasar Baru, Bandung, Jawa Barat 40123</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="bi bi-telephone me-3 text-primary"></i>
                        <span>(022) 420-XXXX / 0812-XXXX-XXXX</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="bi bi-envelope me-3 text-primary"></i>
                        <span>cs@seragamku.com</span>
                    </li>
                    <li class="mb-2 d-flex align-items-center">
                        <i class="bi bi-clock me-3 text-primary"></i>
                        <span>Senin - Sabtu: 08.00 - 17.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-secondary opacity-25">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-secondary mb-0 small">
                    &copy; {{ date('Y') }} <strong>SeragamKu</strong>. Penyedia Seragam Sekolah No. 1 di Indonesia.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <div class="payment-icons">
                    {{-- Ganti dengan icon bank/payment yang sesuai di Indonesia --}}
                    <span class="badge bg-light text-dark me-1">BCA</span>
                    <span class="badge bg-light text-dark me-1">BNI</span>
                    <span class="badge bg-light text-dark me-1">MANDIRI</span>
                    <span class="badge bg-light text-dark me-1">OVO/GOPAY</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-link:hover {
        color: #fff !important;
        padding-left: 5px;
        transition: all 0.3s ease;
    }
    .hover-primary:hover {
        color: #0d6efd !important;
    }
    .payment-icons .badge {
        font-size: 0.7rem;
        padding: 5px 10px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>