@extends('layouts.hotel')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Script Library Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    {{-- Script SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="pt-32 pb-20 bg-gray-50 min-h-screen font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Simple --}}
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Konfirmasi Booking</h1>
                <p class="text-gray-500 mt-2">Lengkapi data diri Anda untuk mengamankan kamar.</p>
            </div>

            <form id="bookingForm">
                {{-- @csrf tidak wajib di sini karena kita pakai meta tag di fetch, tapi boleh dibiarkan --}}
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                {{-- Input hidden price untuk referensi JS --}}
                <input type="hidden" id="pricePerNight" value="{{ $room->price }}">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                    {{-- KOLOM KIRI: Form Input (Lebar 7/12) --}}
                    <div class="lg:col-span-7 space-y-6">

                        {{-- Section 1: Data Pemesan --}}
                        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                Data Pemesan
                            </h2>

                            <div class="space-y-5">
                                {{-- Nama --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fa-solid fa-id-card text-gray-400"></i>
                                        </div>
                                        <input type="text" name="name"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none bg-gray-50 focus:bg-white"
                                            placeholder="Nama sesuai KTP/Paspor" required>
                                    </div>
                                </div>

                                {{-- Email & HP --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fa-solid fa-envelope text-gray-400"></i>
                                            </div>
                                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed outline-none"
                                                readonly required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">No. WhatsApp</label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fa-brands fa-whatsapp text-gray-400"></i>
                                            </div>
                                            <input type="number" name="phone"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none bg-gray-50 focus:bg-white"
                                                placeholder="0812..." required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Section 2: Tanggal Menginap --}}
                        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>
                                Jadwal Menginap
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Check-In</label>
                                    <input type="date" name="check_in" id="checkIn" value="{{ request('check_in') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none cursor-pointer"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Check-Out</label>
                                    <input type="date" name="check_out" id="checkOut" value="{{ request('check_out') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all outline-none cursor-pointer"
                                        required>
                                </div>
                            </div>

                            {{-- Alert Info --}}
                            <div class="mt-4 p-4 bg-blue-50 rounded-xl flex items-start gap-3">
                                <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                                <p class="text-sm text-blue-700 leading-relaxed">
                                    Waktu Check-in mulai pukul <strong>14:00</strong> dan Check-out maksimal pukul
                                    <strong>12:00</strong> siang.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Sticky Summary (Lebar 5/12) --}}
                    <div class="lg:col-span-5">
                        <div class="sticky top-28 space-y-6">

                            {{-- Card Ringkasan --}}
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                                {{-- Header Kamar --}}
                                <div class="relative h-48">
                                    <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                        class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 text-white">
                                        <p class="text-sm opacity-90">{{ $room->type }}</p>
                                        <h3 class="text-xl font-bold">{{ $room->name }}</h3>
                                    </div>
                                </div>

                                <div class="p-6">
                                    {{-- Rincian Biaya --}}
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between text-gray-600">
                                            <span>Harga per malam</span>
                                            <span class="font-medium text-gray-900">Rp
                                                {{ number_format($room->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-gray-600">
                                            <span>Durasi Menginap</span>
                                            <span class="font-medium text-gray-900" id="durationText">0 Malam</span>
                                        </div>
                                        <div class="flex justify-between text-green-600">
                                            <span>Biaya Layanan</span>
                                            <span class="font-bold">GRATIS</span>
                                        </div>
                                    </div>

                                    {{-- Garis Putus --}}
                                    <div class="my-6 border-t-2 border-dashed border-gray-200 relative">
                                        <div class="absolute -left-8 -top-3 w-6 h-6 bg-gray-50 rounded-full"></div>
                                        <div class="absolute -right-8 -top-3 w-6 h-6 bg-gray-50 rounded-full"></div>
                                    </div>

                                    {{-- Total --}}
                                    <div class="flex justify-between items-end mb-6">
                                        <span class="text-gray-600 font-semibold">Total Pembayaran</span>
                                        <span class="text-2xl font-extrabold text-orange-600" id="totalPrice">Rp 0</span>
                                    </div>

                                    {{-- Button Bayar --}}
                                    <button type="button" id="pay-button"
                                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1 shadow-lg shadow-orange-200 flex items-center justify-center gap-2">
                                        <span>Lanjut Pembayaran</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>

                                    {{-- Secure Info --}}
                                    <div class="mt-6 flex flex-col items-center gap-2">
                                        <div class="flex items-center gap-1 text-xs text-gray-400">
                                            <i class="fa-solid fa-lock"></i> Pembayaran Aman & Terenkripsi
                                        </div>
                                        {{-- Payment Icons (Hiasan) --}}
                                        <div class="flex gap-2 opacity-60 grayscale hover:grayscale-0 transition-all">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg"
                                                class="h-4">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                                                class="h-4">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg"
                                                class="h-4">
                                            <span class="text-[10px] text-gray-400 self-center">+ QRIS/BCA/BNI</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- VARIABEL ---
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');
            const priceInput = document.getElementById('pricePerNight');
            const totalDisplay = document.getElementById('totalPrice');
            const durationDisplay = document.getElementById('durationText');
            const payButton = document.getElementById('pay-button');
            const form = document.getElementById('bookingForm');

            // --- FUNGSI FORMAT RUPIAH ---
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            // --- FUNGSI HITUNG TOTAL ---
            function calculateTotal() {
                const pricePerNight = parseFloat(priceInput.value) || 0;
                const d1 = new Date(checkInInput.value);
                const d2 = new Date(checkOutInput.value);

                // Validasi: checkin & checkout valid, dan checkout > checkin
                if (!isNaN(d1) && !isNaN(d2) && d2 > d1) {
                    const diffTime = Math.abs(d2 - d1);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const total = diffDays * pricePerNight;

                    // Update UI
                    totalDisplay.innerText = formatter.format(total);
                    durationDisplay.innerText = diffDays + " Malam";

                    // Enable tombol jika valid
                    payButton.disabled = false;
                    payButton.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    // Reset UI jika tanggal tidak valid
                    totalDisplay.innerText = "Rp 0";
                    durationDisplay.innerText = "0 Malam";
                }
            }

            // Jalankan saat load & saat tanggal berubah
            calculateTotal();
            checkInInput.addEventListener('change', calculateTotal);
            checkOutInput.addEventListener('change', calculateTotal);

            // --- LOGIKA PEMBAYARAN (AJAX KE BACKEND -> BARU KE MIDTRANS) ---
            if (payButton) {
                payButton.addEventListener('click', async function(e) {
                    e.preventDefault();

                    // 1. Validasi Form HTML5 (Cek apakah Nama sudah diisi)
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    // 2. Ubah Tombol jadi Loading
                    const originalContent = payButton.innerHTML;
                    payButton.disabled = true;
                    payButton.innerHTML =
                        '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses Token...';

                    try {
                        // 3. Ambil SEMUA data form saat ini (Nama yang baru diketik, dll)
                        const formData = new FormData(form);

                        // 4. Kirim ke Laravel untuk dibuatkan Token Baru
                        // PENTING: Pastikan route ini sesuai dengan route di web.php kamu
                        const response = await fetch("{{ route('booking.process') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'Gagal membuat pesanan');
                        }

                        // 5. Token Baru Diterima! Munculkan Popup Midtrans
                        console.log('New Snap Token:', data.snap_token);

                        window.snap.pay(data.snap_token, {
                            // SUKSES
                            onSuccess: function(result) {
                                Swal.fire({
                                    title: 'Pembayaran Berhasil! 🎉',
                                    text: 'Terima kasih, pesanan kamar Anda telah dikonfirmasi.',
                                    icon: 'success',
                                    confirmButtonText: 'Lihat Tiket',
                                    confirmButtonColor: '#ea580c',
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect ke halaman sukses/tiket
                                        window.location.href = "/";
                                    }
                                });
                            },

                            // PENDING
                            onPending: function(result) {
                                Swal.fire({
                                    title: 'Menunggu Pembayaran ⏳',
                                    text: 'Silakan selesaikan pembayaran sesuai instruksi.',
                                    icon: 'info',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#3085d6'
                                });
                            },

                            // ERROR
                            onError: function(result) {
                                Swal.fire({
                                    title: 'Pembayaran Gagal ❌',
                                    text: 'Terjadi kesalahan saat memproses pembayaran.',
                                    icon: 'error',
                                    confirmButtonText: 'Coba Lagi'
                                });
                                // Kembalikan tombol
                                payButton.disabled = false;
                                payButton.innerHTML = originalContent;
                            },

                            // CLOSE
                            onClose: function() {
                                Swal.fire({
                                    title: 'Dibatalkan',
                                    text: 'Anda menutup popup tanpa menyelesaikan pembayaran.',
                                    icon: 'warning',
                                    confirmButtonText: 'Lanjut Bayar'
                                });
                                // Kembalikan tombol
                                payButton.disabled = false;
                                payButton.innerHTML = originalContent;
                            }
                        });

                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: error.message || 'Terjadi kesalahan sistem.'
                        });
                        payButton.disabled = false;
                        payButton.innerHTML = originalContent;
                    }
                });
            }
        });
    </script>
@endsection