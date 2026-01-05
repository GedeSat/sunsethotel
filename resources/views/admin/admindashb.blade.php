@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-rose-50 px-4 sm:px-6 py-8 font-sans">
    <div class="max-w-7xl mx-auto">

        {{-- 1. Header Section --}}
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-rose-500">Sunset</span> Dashboard
                </h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base">
                    Selamat datang kembali. Berikut adalah performa properti Anda hari ini.
                </p>
            </div>
            <div class="hidden md:block">
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-white border border-orange-100 shadow-sm text-sm text-gray-600">
                    <i class="fa-regular fa-calendar md:mr-2 text-orange-400"></i> {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>

        {{-- 2. Grid Statistik (Cards) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            {{-- CARD 1: Total Booking (Golden Hour) --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg shadow-orange-500/5 hover:shadow-orange-500/10 transition-all duration-300 border-l-4 border-orange-500 group relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-orange-100 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between z-10">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Booking</p>
                        <p class="text-4xl font-extrabold mt-2 text-gray-800 group-hover:text-orange-600 transition-colors">
                            {{ $totalBookings }}
                        </p>
                        <a href="#" class="text-xs text-orange-500 mt-4 inline-flex items-center gap-1 font-medium hover:underline">
                            Lihat detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                    <div class="h-14 w-14 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-xl flex items-center justify-center shadow-lg shadow-orange-200 group-hover:rotate-12 transition-transform">
                        <i class="fa-solid fa-calendar-check text-white text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- CARD 2: Kamar Tersedia (Twilight Blue) --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg shadow-blue-500/5 hover:shadow-blue-500/10 transition-all duration-300 border-l-4 border-blue-500 group relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between z-10">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Kamar Tersedia</p>
                        <p class="text-4xl font-extrabold mt-2 text-gray-800 group-hover:text-blue-600 transition-colors">
                            {{ $availableRooms }}
                        </p>
                        <div class="text-xs text-blue-500 mt-4 inline-flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-check-circle"></i> Siap Check-in
                        </div>
                    </div>
                    <div class="h-14 w-14 bg-gradient-to-br from-blue-500 to-indigo-400 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:rotate-12 transition-transform">
                        <i class="fa-solid fa-bed text-white text-xl"></i>
                    </div>
                </div>
            </div>

            {{-- CARD 3: Total User (Warm Coral) --}}
            <div class="bg-white rounded-2xl p-6 shadow-lg shadow-rose-500/5 hover:shadow-rose-500/10 transition-all duration-300 border-l-4 border-rose-500 group relative overflow-hidden">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between z-10">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Total Tamu</p>
                        <p class="text-4xl font-extrabold mt-2 text-gray-800 group-hover:text-rose-600 transition-colors">
                            {{ $totalUsers }}
                        </p>
                        <a href="#" class="text-xs text-rose-500 mt-4 inline-flex items-center gap-1 font-medium hover:underline">
                            Data pelanggan <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                    <div class="h-14 w-14 bg-gradient-to-br from-rose-500 to-pink-400 rounded-xl flex items-center justify-center shadow-lg shadow-rose-200 group-hover:rotate-12 transition-transform">
                        <i class="fa-solid fa-users text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Area Tabel Aktivitas Terbaru (Major Redesign) --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-orange-100 overflow-hidden">
            
            {{-- Table Header --}}
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-orange-50/30">
                <div class="flex items-center gap-3">
                    <div class="bg-orange-100 p-2 rounded-lg">
                        <i class="fa-solid fa-clock-rotate-left text-orange-600"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Aktivitas Booking Terbaru</h2>
                </div>
                <button class="text-sm text-gray-500 hover:text-orange-600 font-medium transition-colors">
                    Lihat Semua
                </button>
            </div>

            {{-- Table Content Wrapper (untuk responsive scroll) --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider font-semibold border-b border-gray-100">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Tamu & Kamar</th>
                            <th class="px-6 py-4">Jadwal</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 text-center">Status Bayar</th>
                            <th class="px-6 py-4 text-center">Status Booking</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($latestBookings as $booking)
                        <tr class="hover:bg-orange-50/40 transition-colors duration-200 group">
                            
                            {{-- Order ID --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono text-xs font-bold text-gray-600 bg-gray-100 px-2 py-1 rounded border border-gray-200">
                                    #{{ $booking->order_id }}
                                </span>
                            </td>

                            {{-- Tamu & Kamar (Digabung agar lebih rapi) --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-800">{{ $booking->user->name ?? 'Guest' }}</span>
                                    <span class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                        <i class="fa-solid fa-door-open text-orange-300"></i> {{ $booking->room->name ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Jadwal (Checkin - Checkout) --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-xs text-gray-600 flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        <span class="w-12 text-gray-400">In:</span>
                                        <span class="font-medium">{{ $booking->check_in }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-12 text-gray-400">Out:</span>
                                        <span class="font-medium">{{ $booking->check_out }}</span>
                                    </div>
                                </div>
                            </td>

                            {{-- Total Harga --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-orange-600">
                                    Rp {{ number_format($booking->total_price) }}
                                </span>
                            </td>

                            {{-- STATUS BAYAR --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($booking->payment_status === 'paid' || $booking->payment_status === 'settlement' || $booking->payment_status === 'success')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> PAID
                                    </span>
                                @elseif($booking->payment_status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span> PENDING
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200 shadow-sm">
                                        {{ strtoupper($booking->payment_status ?? 'EXPIRED') }}
                                    </span>
                                @endif
                            </td>

                            {{-- STATUS BOOKING --}}
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($booking->status === 'confirmed')
                                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-lg border border-green-100">
                                        Confirmed
                                    </span>
                                @elseif($booking->status === 'pending')
                                    <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-3 py-1 rounded-lg border border-yellow-100">
                                        Pending
                                    </span>
                                @else
                                    <span class="text-xs font-bold text-red-600 bg-red-50 px-3 py-1 rounded-lg border border-red-100">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="bg-gray-50 p-4 rounded-full mb-3">
                                        <i class="fa-regular fa-folder-open text-3xl text-orange-300"></i>
                                    </div>
                                    <p class="font-medium text-gray-500">Belum ada data booking terbaru.</p>
                                    <p class="text-sm mt-1">Pesanan baru akan muncul di sini secara otomatis.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Table Footer Decoration --}}
            <div class="h-2 bg-gradient-to-r from-orange-400 via-rose-400 to-orange-400"></div>
        </div>

    </div>
</div>
@endsection