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
                
                {{-- Header dengan Gradasi --}}
                <div class="card-header bg-primary bg-gradient text-white text-center py-4 border-0">
                    <h3 class="fw-bold mb-0">Selamat Datang</h3>
                    <p class="small mb-0 opacity-75">Silakan masuk ke akun Anda</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Input Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-secondary">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope"></i></span>
                                <input id="email" type="email" 
                                    class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required 
                                    placeholder="contoh@email.com" autofocus>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-semibold text-secondary">Password</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                <input id="password" type="password" 
                                    class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="••••••••">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted small" for="remember">
                                Ingat saya di perangkat ini
                            </label>
                        </div>

                        {{-- Button Login --}}
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold py-2" style="border-radius: 10px;">
                                Masuk Sekarang
                            </button>
                        </div>

                        {{-- Divider --}}
                        <div class="position-relative mb-4">
                            <hr class="text-secondary">
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">Atau</span>
                        </div>

                        {{-- Social Login --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('auth.google') }}" class="btn btn-outline-dark py-2 d-flex align-items-center justify-content-center" style="border-radius: 10px;">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg" width="20" class="me-2" alt="Google">
                                Lanjutkan dengan Google
                            </a>
                        </div>

                        {{-- Link Register --}}
                        <div class="mt-5 text-center">
                            <p class="text-muted mb-0">Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Footer Opsional --}}
            <div class="text-center mt-4 text-muted small">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</div>

{{-- Tambahkan styling CSS --}}
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