@extends('layouts.hotel')

@section('content')
{{-- Script Library Midtrans (Wajib ada) --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<div class="pt-28 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-6">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Selesaikan Pembayaran Anda</h1>

        <form id="bookingForm" method="POST" action="#">
            @csrf
            {{-- Hidden Input untuk menyimpan ID Kamar & Harga --}}
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" id="pricePerNight" value="{{ $room->price }}">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- KOLOM KIRI: Form Data Diri --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Card Data Tamu --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-user text-orange-500"></i> Informasi Tamu
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-2.5 bg-gray-50" placeholder="Sesuai KTP" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-2.5 bg-gray-50" placeholder="email@contoh.com" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon / WA</label>
                                <input type="number" name="phone" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-2.5 bg-gray-50" required>
                            </div>
                        </div>
                    </div>

                    {{-- Card Tanggal --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-calendar-days text-orange-500"></i> Detail Menginap
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-In</label>
                                <input type="date" name="check_in" id="checkIn" 
                                       value="{{ request('check_in') }}"
                                       class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-2.5" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Check-Out</label>
                                <input type="date" name="check_out" id="checkOut" 
                                       value="{{ request('check_out') }}"
                                       class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 p-2.5" required>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 italic">*Minimal menginap 1 malam</p>
                    </div>

                </div>

                {{-- KOLOM KANAN: Ringkasan Pesanan (Otomatis) --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border-t-4 border-orange-500 sticky top-28">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                        
                        {{-- Info Kamar --}}
                        <div class="flex gap-4 mb-4 border-b border-gray-100 pb-4">
                            <img src="{{ $room->image 
                                ? asset('storage/'.$room->image) 
                                : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                class="w-20 h-20 object-cover rounded-lg">
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $room->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $room->type }}</p>
                                <div class="text-sm text-orange-600 font-semibold mt-1">
                                    Rp {{ number_format($room->price, 0, ',', '.') }} <span class="text-gray-400 font-normal">/ malam</span>
                                </div>
                            </div>
                        </div>

                        {{-- Kalkulasi Harga --}}
                        <div class="space-y-3 text-sm text-gray-600 mb-6">
                            <div class="flex justify-between">
                                <span>Harga per malam</span>
                                <span>Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Durasi</span>
                                {{-- PERBAIKAN: ID ini akan diupdate oleh JS --}}
                                <span id="durationText">0 Malam</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Diskon & Pajak</span>
                                <span>Termasuk</span>
                            </div>
                            <div class="border-t border-dashed border-gray-300 my-2"></div>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg text-gray-800">Total Bayar</span>
                                {{-- PERBAIKAN: ID di sini 'totalPrice' --}}
                                <span class="font-bold text-2xl text-orange-600" id="totalPrice">Rp 0</span>
                            </div>
                        </div>

                        <button type="button" id="pay-button" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-xl transition duration-300 shadow-lg shadow-orange-200">
                            Lanjut ke Pembayaran <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>
                        
                        <p class="text-xs text-center text-gray-400 mt-4">
                            <i class="fa-solid fa-lock"></i> Transaksi Anda aman & terenkripsi
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- LOGIKA HITUNG HARGA OTOMATIS ---
        const checkInInput = document.querySelector('input[name="check_in"]');
        const checkOutInput = document.querySelector('input[name="check_out"]');
        const priceInput = document.getElementById('pricePerNight');
        
        // Perbaikan: Ambil ID yang benar dari HTML ('totalPrice' bukan 'totalPriceDisplay')
        const totalDisplay = document.getElementById('totalPrice'); 
        const durationDisplay = document.getElementById('durationText'); // Ambil elemen Durasi
        
        // Fungsi Hitung
        function calculateTotal() {
            const pricePerNight = parseFloat(priceInput.value) || 0;
            const d1 = new Date(checkInInput.value);
            const d2 = new Date(checkOutInput.value);

            // Cek apakah tanggal valid & CheckOut lebih besar dari CheckIn
            if (!isNaN(d1) && !isNaN(d2) && d2 > d1) {
                const diffTime = Math.abs(d2 - d1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const total = diffDays * pricePerNight;

                // Update Tampilan Harga
                if(totalDisplay) {
                    totalDisplay.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(total);
                }
                
                // Update Tampilan Durasi
                if(durationDisplay) {
                    durationDisplay.innerText = diffDays + " Malam";
                }

            } else {
                if(totalDisplay) totalDisplay.innerText = "Rp 0";
                if(durationDisplay) durationDisplay.innerText = "0 Malam";
            }
        }

        // 1. Jalankan hitungan SAAT HALAMAN DIMUAT (Otomatis hitung dari URL)
        calculateTotal();

        // 2. Jalankan hitungan SAAT TANGGAL DIGANTI
        checkInInput.addEventListener('change', calculateTotal);
        checkOutInput.addEventListener('change', calculateTotal);


        // --- LOGIKA TOMBOL BAYAR (AJAX) ---
        const payButton = document.getElementById('pay-button');
        const form = document.getElementById('bookingForm'); 

        if(payButton) {
            payButton.addEventListener('click', async function(e) {
                e.preventDefault();

                // Ubah tombol jadi loading
                const originalText = payButton.innerHTML;
                payButton.disabled = true;
                payButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

                try {
                    const formData = new FormData(form);
                    
                    // Kirim ke Backend
                    const response = await fetch("{{ route('booking.process') }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    // Cek Error Validasi
                    if (!response.ok) {
                        const errorData = await response.json();
                        alert("Mohon lengkapi data: " + (errorData.message || 'Cek kembali inputan Anda'));
                        throw new Error('Validasi Gagal');
                    }

                    // Ambil Token
                    const data = await response.json();
                    
                    // Munculkan Midtrans
                    snap.pay(data.snap_token, {
                        onSuccess: function(result){
                            alert("Pembayaran Berhasil!");
                            window.location.href = "/"; 
                        },
                        onPending: function(result){
                            alert("Menunggu Pembayaran!");
                        },
                        onError: function(result){
                            alert("Pembayaran Gagal!");
                        },
                        onClose: function(){
                            payButton.disabled = false;
                            payButton.innerHTML = originalText;
                        }
                    });

                } catch (error) {
                    console.error(error);
                    payButton.disabled = false;
                    payButton.innerHTML = originalText;
                }
            });
        }
    });
</script>
@endsection