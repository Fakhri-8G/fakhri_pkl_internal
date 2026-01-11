<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSRF Token untuk AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', 'Toko Online') - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Toko online terpercaya dengan produk berkualitas')">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Stack untuk CSS tambahan per halaman --}}
    @stack('styles')

     <!-- ... meta tags ... -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Stack untuk
    script tambahan dari child view --}} @stack('scripts')
</head>
<body>
    <div class="container mt-3">
        @include('partials.flash-messages')
    </div>

    <div class="container py-5">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            
            {{-- Card Utama --}}
            <div class="card border-0 shadow-lg" style="border-radius: 1.25rem; overflow: hidden;">
                
                {{-- Header dengan Gradasi & Logo --}}
                <div class="card-header bg-primary bg-gradient text-white py-4 border-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="fw-bold mb-0 me-2">Atur Ulang</h3>
                    </div>
                    <p class="small mb-0 opacity-75 text-center mt-1">Masukkan kata sandi baru Anda</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        {{-- Token Hidden Field --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Input Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-secondary small">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" 
                                    class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                    name="email" value="{{ $email ?? old('email') }}" required 
                                    autocomplete="email" autofocus placeholder="email@anda.com">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Input Password Baru --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-secondary small">Password Baru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" 
                                    class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="Minimal 8 karakter">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold text-secondary small">Ulangi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check"></i></span>
                                <input id="password-confirm" type="password" 
                                    class="form-control bg-light border-start-0" 
                                    name="password_confirmation" required placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        {{-- Button Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold py-2" style="border-radius: 10px;">
                                Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small">
                Kembali ke <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Halaman Login</a>
            </div>
        </div>
    </div>
</div>

{{-- Styling Tambahan --}}
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
        background-color: #fff !important;
    }
    .input-group-text {
        color: #6c757d;
        border-radius: 10px 0 0 10px;
    }
    .form-control {
        border-radius: 0 10px 10px 0;
    }
    .btn-primary {
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3) !important;
    }
</style>

</body>
</html>