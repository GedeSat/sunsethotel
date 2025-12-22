@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--
    Catatan: Pastikan layout Anda sudah memuat:
    1. Tailwind CSS
    2. FontAwesome (atau ganti ikon <i> dengan SVG Heroicons jika Anda menggunakannya)
--}}

{{-- Gunakan latar belakang dengan gradien halus yang hangat, bukan abu-abu/putih standar --}}
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-slate-50 px-6 py-8">
    <div class="container mx-auto">

        {{-- Header Section dengan sentuhan personal --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                <span class="text-orange-600">Sunset</span> Admin Dashboard
            </h1>
            <p class="text-gray-500 mt-2">Selamat datang kembali. Berikut adalah ringkasan properti Anda hari ini.</p>
        </div>

        {{-- Grid Statistik --}}
        <div class="grid md:grid-cols-3 gap-6">

            {{-- CARD 1: Total Booking (Tema: Golden Hour - Oranye/Emas) --}}
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(249,115,22,0.15)] hover:shadow-[0_8px_30px_-4px_rgba(249,115,22,0.2)] transition-all duration-300 group border-b-4 border-orange-400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Booking</p>
                        <p class="text-4xl font-extrabold mt-3 text-gray-800 group-hover:text-orange-600 transition-colors">
                            {{ $totalBookings }}
                        </p>
                        <a href="#" class="text-xs text-orange-500 mt-2 inline-flex items-center gap-1 hover:underline">
                            Lihat semua pesanan <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    {{-- Icon Container dengan Gradient --}}
                    <div class="h-16 w-16 bg-gradient-to-tr from-orange-400 to-yellow-300 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-check text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            {{-- CARD 2: Kamar Tersedia (Tema: Twilight - Biru Senja) --}}
            {{-- Menggunakan warna biru untuk kontras "ketersediaan" yang tenang --}}
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(59,130,246,0.15)] hover:shadow-[0_8px_30px_-4px_rgba(59,130,246,0.2)] transition-all duration-300 group border-b-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Kamar Tersedia</p>
                        <p class="text-4xl font-extrabold mt-3 text-gray-800 group-hover:text-blue-600 transition-colors">
                            {{ $availableRooms }}
                        </p>
                        <div class="text-xs text-blue-500 mt-2 inline-flex items-center gap-1">
                            Siap untuk tamu check-in
                        </div>
                    </div>
                    {{-- Icon Container dengan Gradient --}}
                    <div class="h-16 w-16 bg-gradient-to-tr from-blue-600 to-indigo-400 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-bed text-white text-2xl"></i>
                    </div>
                </div>
            </div>

            {{-- CARD 3: Total User (Tema: Warm Coral - Merah Koral) --}}
            <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(236,72,153,0.15)] hover:shadow-[0_8px_30px_-4px_rgba(236,72,153,0.2)] transition-all duration-300 group border-b-4 border-rose-400">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total User Terdaftar</p>
                        <p class="text-4xl font-extrabold mt-3 text-gray-800 group-hover:text-rose-600 transition-colors">
                            {{ $totalUsers }}
                        </p>
                        <a href="#" class="text-xs text-rose-500 mt-2 inline-flex items-center gap-1 hover:underline">
                            Kelola pengguna <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    {{-- Icon Container dengan Gradient --}}
                    <div class="h-16 w-16 bg-gradient-to-tr from-rose-500 to-orange-300 rounded-2xl flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-users text-white text-2xl"></i>
                    </div>
                </div>
            </div>

        </div>

        {{-- Contoh Tambahan (Opsional): Area Aktivitas Terbaru --}}
        <div class="mt-10">
             <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>
             <div class="bg-white rounded-2xl shadow-sm border border-orange-100 p-6 flex flex-col items-center justify-center text-gray-400 h-48 bg-[url('data:image/svg+xml,%3Csvg width=%2220%22 height=%2220%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M0 0h20v20H0z%22 fill=%22%23fff%22 fill-opacity=%221%22/%3E%3Cpath d=%22M0 0h10v10H0zM10 10h10v10H10z%22 fill=%22%23fff7ed%22 fill-opacity=%221%22/%3E%3C/svg%3E')]">
                <i class="fa-regular fa-sun text-4xl text-orange-300 mb-3"></i>
                <p>Belum ada aktivitas terbaru hari ini.</p>
             </div>
        </div>

    </div>
</div>

@endsection