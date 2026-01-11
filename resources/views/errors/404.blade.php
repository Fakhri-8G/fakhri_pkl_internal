<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Toko Seragam</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-blue-600">404</h1>
            <p class="text-2xl md:text-3xl font-light text-gray-700 mt-4">
                Waduh! Halaman tidak ditemukan.
            </p>
        </div>

        <p class="text-gray-500 mb-8 max-w-md mx-auto">
            Mungkin halaman yang Anda cari sudah pindah sekolah atau sedang tidak tersedia di rak kami.
        </p>

        <a href="{{ url('/') }}" 
           class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>