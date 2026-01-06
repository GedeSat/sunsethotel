@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-rose-50 px-4 sm:px-6 py-8 font-sans">
        <div class="max-w-7xl mx-auto">

            {{-- 1. NOTIFIKASI SUKSES --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative shadow-sm"
                    role="alert">
                    <strong class="font-bold"><i class="fa-solid fa-check-circle mr-1"></i> Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- 2. Header Section --}}
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight">
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-rose-500">Sunset</span>
                        Dashboard
                    </h1>
                    <p class="text-gray-500 mt-2 text-sm md:text-base">
                        Kelola booking tamu, check-in, dan check-out dengan mudah.
                    </p>
                </div>
                <div class="hidden md:block">
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full bg-white border border-orange-100 shadow-sm text-sm text-gray-600">
                        <i class="fa-regular fa-calendar md:mr-2 text-orange-400"></i> {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            {{-- 3. Tabel Aktivitas --}}
            <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-orange-100 overflow-hidden">

                {{-- Table Header & Search Bar --}}
                <div
                    class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-orange-50/30">

                    {{-- Judul Kiri --}}
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-100 p-2 rounded-lg">
                            <i class="fa-solid fa-magnifying-glass text-orange-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Cari Booking</h2>
                            <p class="text-xs text-gray-500">Masukkan Order ID atau Nama Tamu</p>
                        </div>
                    </div>

                    {{-- FORM PENCARIAN --}}
                    <form action="{{ route('admin.bookings') }}" method="GET" class="w-full sm:w-auto">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i
                                    class="fa-solid fa-barcode text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-full sm:w-80 p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-orange-500 focus:border-orange-500 transition-all shadow-sm"
                                placeholder="Contoh: ORD-2024...">
                            <button type="submit"
                                class="absolute inset-y-0 right-0 px-4 text-sm font-medium text-white bg-orange-500 rounded-r-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 transition-colors">
                                Cari
                            </button>
                        </div>
                    </form>

                    {{-- Tombol Reset --}}
                    @if (request('search'))
                        <a href="{{ route('admin.bookings') }}"
                            class="text-sm text-rose-500 hover:text-rose-700 underline font-medium">
                            <i class="fa-solid fa-xmark"></i> Reset
                        </a>
                    @endif
                </div>

                {{-- DAFTAR TABEL (YANG TADI HILANG TAG PEMBUKANYA) --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Tamu & Kamar</th>
                                <th class="px-6 py-4">Jadwal</th>
                                <th class="px-6 py-4">Status Pembayaran</th>
                                <th class="px-6 py-4 text-center">Aksi (Check In/Out)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">

                            {{-- FIX: Menggunakan variabel $bookings sesuai Controller --}}
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-orange-50/40 transition-colors duration-200 group">

                                    {{-- Tamu & Kamar --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-gray-800">{{ $booking->user->name ?? ($booking->name ?? 'Guest') }}</span>
                                            <span class="text-xs text-gray-500 mb-1">Ord: #{{ $booking->order_id }}</span>
                                            <span
                                                class="text-xs text-orange-500 font-medium bg-orange-50 px-2 py-0.5 rounded w-fit border border-orange-100">
                                                {{ $booking->room->name ?? '-' }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Jadwal --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs text-gray-600 flex flex-col gap-1">
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-arrow-right-to-bracket text-green-500 w-4"></i>
                                                <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</span>
                                                @if ($booking->check_in_time)
                                                    <span
                                                        class="text-[10px] text-gray-400">({{ \Carbon\Carbon::parse($booking->check_in_time)->diffForHumans() }})</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fa-solid fa-arrow-right-from-bracket text-red-500 w-4"></i>
                                                <span
                                                    class="font-medium">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</span>
                                                @if ($booking->check_out_time)
                                                    <span
                                                        class="text-[10px] text-gray-400">({{ \Carbon\Carbon::parse($booking->check_out_time)->diffForHumans() }})</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- STATUS BAYAR --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($booking->payment_status === 'paid' || $booking->payment_status === 'settlement')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                                LUNAS
                                            </span>
                                        @elseif($booking->payment_status === 'unpaid' || $booking->payment_status === 'pending')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                BELUM BAYAR
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                                {{ strtoupper($booking->payment_status) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- TOMBOL AKSI CHECK IN / OUT --}}
                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        {{-- KONDISI 1: SUDAH BOOKING, BELUM MASUK --}}
                                        {{-- KONDISI 1: SIAP CHECK IN (Bisa Booked, Confirmed, atau Paid) --}}
                                        @if ($booking->status === 'booked' || $booking->status === 'confirmed' || $booking->status === 'paid')
                                            <form id="checkInForm_{{ $booking->id }}"
                                                action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="status" value="checked_in">

                                                <button type="button"
                                                    onclick="confirmCheckIn('{{ $booking->id }}', '{{ $booking->user->name ?? 'Tamu' }}')"
                                                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white text-xs font-bold rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                                    <i class="fa-solid fa-key mr-2"></i> </i> Check-In
                                                </button>
                                            </form>

                                            {{-- KONDISI 2: TAMU SEDANG MENGINAP (SUDAH CHECK IN) --}}
                                        @elseif($booking->status === 'checked_in')
                                            <div class="flex flex-col gap-2">
                                                <span
                                                    class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">
                                                    Sedang Menginap
                                                </span>
                                                {{-- Form Check-Out dengan SweetAlert2 --}}
                                                <form id="checkOutForm_{{ $booking->id }}"
                                                    action="{{ route('admin.bookings.update', $booking->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="status" value="checked_out">

                                                    {{-- Perhatikan: type="button" dan event onclick --}}
                                                    <button type="button"
                                                        onclick="confirmCheckOut('{{ $booking->id }}', '{{ $booking->user->name ?? 'Tamu' }}')"
                                                        class="w-full inline-flex justify-center items-center px-3 py-1.5 bg-white border border-rose-500 text-rose-500 hover:bg-rose-50 text-xs font-bold rounded-lg transition-colors">
                                                        <i class="fa-solid fa-person-walking-luggage mr-1"></i> Check Out
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- KONDISI 3: SUDAH SELESAI (CHECK OUT) --}}
                                        @elseif($booking->status === 'checked_out')
                                            <div class="flex flex-col items-center">
                                                <span
                                                    class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full mb-1">
                                                    Selesai
                                                </span>
                                                <span class="text-[10px] text-gray-400">
                                                    {{ $booking->check_out_time ? \Carbon\Carbon::parse($booking->check_out_time)->format('d M H:i') : '' }}
                                                </span>
                                            </div>

                                            {{-- KONDISI LAIN --}}
                                        @else
                                            <span
                                                class="text-xs font-bold text-gray-400 bg-gray-50 px-3 py-1 rounded border border-gray-200">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <div class="bg-gray-50 p-4 rounded-full mb-3">
                                                <i class="fa-regular fa-folder-open text-3xl text-orange-300"></i>
                                            </div>
                                            <p class="font-medium text-gray-500">Belum ada data booking.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="h-2 bg-gradient-to-r from-orange-400 via-rose-400 to-orange-400"></div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmCheckIn(bookingId, guestName) {
        Swal.fire({
            title: 'Konfirmasi Check-In',
            text: `Apakah tamu atas nama "${guestName}" sudah datang di lokasi?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#22c55e', // Warna Hijau (Tailwind green-500)
            cancelButtonColor: '#d33', // Warna Merah
            confirmButtonText: 'Ya, Check-In Sekarang!',
            cancelButtonText: 'Batal',
            reverseButtons: true, // Tombol batal di kiri, ya di kanan
            backdrop: `
                rgba(0,0,123,0.4)
                left top
                no-repeat
            `
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading saat proses submit
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form secara manual berdasarkan ID
                document.getElementById('checkInForm_' + bookingId).submit();
            }
        });
    }

    function confirmCheckOut(bookingId, guestName) {
        Swal.fire({
            title: 'Konfirmasi Check-Out',
            // Pesan ini mengingatkan admin untuk cek properti sebelum tamu pergi
            html: `Apakah tamu <b>${guestName}</b> akan meninggalkan hotel?<br><small class="text-gray-500">Pastikan kunci kamar sudah dikembalikan.</small>`,
            icon: 'warning', // Ikon peringatan (kuning)
            showCancelButton: true,
            confirmButtonColor: '#f43f5e', // Warna Rose-500 (Sesuai tombol Anda)
            cancelButtonColor: '#64748b', // Warna Abu-abu (Slate)
            confirmButtonText: 'Ya, Check-Out',
            cancelButtonText: 'Batal',
            focusCancel: true, // Fokus ke tombol batal untuk keamanan (mencegah klik tidak sengaja)
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading spinner
                Swal.fire({
                    title: 'Memproses Check-Out...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form
                document.getElementById('checkOutForm_' + bookingId).submit();
            }
        });
    }
</script>
