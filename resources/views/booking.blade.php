@extends('layouts.hotel')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- HERO SECTION & BOOKING FORM --}}
    <section class="relative min-h-[85vh] flex items-center justify-center bg-gray-900 overflow-hidden">

        {{-- Background Image (Sunset Theme) --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1920&q=80"
                class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center pt-20">

            {{-- Text Content --}}
            <div class="text-white space-y-6" data-aos="fade-right">
                <span
                    class="px-3 py-1 border border-orange-400 text-orange-400 rounded-full text-xs font-bold uppercase tracking-widest">
                    Official Reservation
                </span>
                <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                    Rencanakan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-200">
                        Liburan Impian
                    </span>
                </h1>
                <p class="text-gray-300 text-lg max-w-md">
                    Pilih kamar eksklusif Anda, tentukan tanggalnya, dan nikmati pengalaman menginap tak terlupakan di
                    Sunset Hotel.
                </p>
            </div>

            {{-- Booking Card (Glassmorphism) --}}
            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-3xl shadow-2xl"
                data-aos="fade-left">
                <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-orange-500"></i> Buat Pesanan Baru
                </h2>

                {{-- Form akan diarahkan ke halaman Payment yang kita buat sebelumnya --}}
                <form id="bookingForm" method="GET" action="#">
                    @csrf
                    <div class="space-y-5">

                        {{-- Pilih Kamar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-200 mb-2">Tipe Kamar</label>
                            <div class="relative">
                                <select name="room_id" id="roomSelect" class="form-select w-full" required>
                                    <option value="">-- Pilih Kamar --</option>

                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" data-price="{{ $room->price }}"
                                            {{ ($selectedRoomId ?? null) == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }} — Rp {{ number_format($room->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>

                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">

                            {{-- Check In --}}
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Check In</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-regular fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="text" id="checkin" name="check_in"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                        placeholder="Pilih Tanggal" required>
                                </div>
                            </div>

                            {{-- Check Out --}}
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Check Out</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fa-regular fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="text" id="checkout" name="check_out"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5"
                                        placeholder="Pilih Tanggal" required>
                                </div>
                            </div>

                            {{-- Estimasi Harga --}}
                            {{-- Menggunakan col-span-2 agar lebar penuh --}}
                            <div
                                class="col-span-2 bg-orange-50 border border-orange-200 rounded-xl p-4 flex justify-between items-center">
                                <span class="text-orange-800 text-sm font-medium">Estimasi Total</span>
                                {{-- Pastikan teks harga kontras, saya ubah text-white jadi text-orange-700 --}}
                                <span class="text-orange-700 font-bold text-lg" id="heroEstimatedPrice">Rp 0</span>
                            </div>

                            {{-- Tombol Submit --}}
                            {{-- Menggunakan col-span-2 agar lebar penuh --}}
                            <button type="button" onclick="submitBooking()"
                                class="col-span-2 w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-orange-500/30 transition transform hover:scale-[1.02] active:scale-95 flex justify-center items-center gap-2">
                                Lanjut ke Pembayaran <i class="fa-solid fa-arrow-right"></i>
                            </button>

                        </div>
                </form>
            </div>
        </div>
    </section>

    {{-- RIWAYAT BOOKING SECTION --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Riwayat Pesanan</h2>
                    <p class="text-gray-500 mt-1">Pantau status reservasi kamar Anda di sini.</p>
                </div>
                {{-- Statistik Singkat (Opsional) --}}
                <div class="hidden md:flex gap-4">
                    <div class="bg-white px-5 py-3 rounded-xl shadow-sm border border-gray-200">
                        <span class="block text-xs text-gray-400 uppercase font-bold">Total Booking</span>
                        <span class="text-xl font-bold text-gray-800">{{ $bookings->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100/50 border-b border-gray-200">
                            <tr>
                                <th class="p-5 text-left text-sm font-semibold text-gray-600">ID Booking</th>
                                <th class="p-5 text-left text-sm font-semibold text-gray-600">Detail Kamar</th>
                                <th class="p-5 text-left text-sm font-semibold text-gray-600">Tanggal Menginap</th>
                                <th class="p-5 text-left text-sm font-semibold text-gray-600">Total Biaya</th>
                                <th class="p-5 text-center text-sm font-semibold text-gray-600">Status</th>
                                <th class="p-5 text-center text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    {{-- KOLOM 1: ID BOOKING --}}
                                    <td class="p-5 align-top">
                                        <span class="font-mono text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                            #{{ $booking->id }}
                                        </span>
                                    </td>

                                    {{-- KOLOM 2: GAMBAR & NAMA KAMAR --}}
                                    <td class="p-5 align-top">
                                        <div class="flex items-start gap-3">
                                            <div class="w-12 h-12 rounded-lg bg-gray-200 overflow-hidden shrink-0">
                                                <img src="{{ asset('storage/' . $booking->room->image) }}"
                                                    class="w-full h-full object-cover">

                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 text-sm">
                                                    {{ $booking->room->name ?? 'Kamar Dihapus' }}
                                                </p>
                                                <p class="text-xs text-gray-500">{{ $booking->room->type ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- KOLOM 3: TANGGAL (YANG TADI ERROR) --}}
                                    <td class="p-5 align-top">
                                        <div class="text-sm text-gray-600 flex flex-col gap-1">

                                            {{-- Tanggal Check In --}}
                                            <div class="flex items-center gap-2">
                                                <span class="font-medium text-gray-800">
                                                    {{ date('d M Y', strtotime($booking->check_in)) }}
                                                </span>

                                                {{-- LOGIKA BADGE CHECK-IN / CANCEL --}}
                                                @if ($booking->status == 'checked_in')
                                                    <span
                                                        class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">
                                                        <i class="fa-solid fa-check mr-1"></i> In
                                                    </span>
                                                @elseif($booking->status == 'canceled')
                                                    <span
                                                        class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-700 border border-red-200">
                                                        <i class="fa-solid fa-ban mr-1"></i> Batal
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Tanggal Check Out --}}
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                                {{ date('d M Y', strtotime($booking->check_out)) }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- KOLOM 4: HARGA --}}
                                    <td class="p-5 align-top">
                                        <span class="font-bold text-orange-600 text-sm">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- KOLOM 5: STATUS --}}
                                    <td class="p-5 align-top text-center">
                                        @php
                                            $statusClass = match ($booking->status) {
                                                'paid',
                                                'confirmed',
                                                'checked_in'
                                                    => 'bg-green-100 text-green-700 border-green-200',
                                                'pending' => 'bg-orange-100 text-orange-700 border-orange-200',
                                                'canceled' => 'bg-red-100 text-red-700 border-red-200',
                                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                                            };
                                            $iconClass = match ($booking->status) {
                                                'paid', 'confirmed', 'checked_in' => 'fa-circle-check',
                                                'pending' => 'fa-clock',
                                                'canceled' => 'fa-circle-xmark',
                                                default => 'fa-circle-question',
                                            };
                                        @endphp
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                            <i class="fa-solid {{ $iconClass }}"></i>
                                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>

                                    {{-- KOLOM 6: AKSI --}}
                                    <td class="p-5 align-top text-center">
                                        @if ($booking->status == 'pending')
                                            {{-- Jika Pending: Muncul Tombol Bayar --}}
                                            <a href="{{ route('booking.payment', $booking->room_id) }}"
                                                class="inline-block bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-2 px-4 rounded-lg transition shadow-md shadow-orange-200">
                                                Bayar
                                            </a>

                                            {{-- Jika Sudah Bayar / Check-in / Selesai: Muncul Tombol Print --}}
                                        @elseif(in_array($booking->status, ['paid', 'confirmed', 'checked_in', 'checked_out']))
                                            <a href="{{ route('booking.invoice', $booking->id) }}" target="_blank"
                                                class="text-gray-400 hover:text-blue-600 transition"
                                                title="Print Invoice">
                                                <i class="fa-solid fa-print text-lg"></i>
                                            </a>
                                        @else
                                            {{-- Jika Cancel / Expired --}}
                                            <span class="text-gray-300">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                            <p>Belum ada riwayat pemesanan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- SCRIPT: Logika Hitung Harga & Submit --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. Inisialisasi Flatpickr Kosong Dulu
            let checkInPicker = flatpickr("#checkin", {
                minDate: "today",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // Saat Check-In dipilih, update minDate Check-Out
                    checkOutPicker.set('minDate', dateStr);
                }
            });

            let checkOutPicker = flatpickr("#checkout", {
                minDate: "today",
                dateFormat: "Y-m-d"
            });

            // 2. Fungsi Ambil Tanggal Merah dari Server
            const roomSelect = document.querySelector('select[name="room_id"]');

            function updateDisabledDates() {
                const roomId = roomSelect.value;

                if (!roomId) return;

                // Tampilkan loading (opsional)
                checkInPicker.clear();
                checkOutPicker.clear();

                fetch(`/api/booked-dates/${roomId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update Flatpickr dengan tanggal yang diblokir
                        checkInPicker.set('disable', data);
                        checkOutPicker.set('disable', data);
                    })
                    .catch(error => console.error('Error fetching dates:', error));
            }

            // 3. Jalankan saat user ganti pilihan kamar
            if (roomSelect) {
                roomSelect.addEventListener('change', updateDisabledDates);

                // Jalankan sekali saat halaman dimuat (jika ada kamar terpilih default)
                if (roomSelect.value) {
                    updateDisabledDates();
                }
            }
        });
        const roomSelect = document.getElementById('roomSelect');
        const checkInHero = document.getElementById('checkin');
        const checkOutHero = document.getElementById('checkout');
        const estDisplay = document.getElementById('heroEstimatedPrice');

        // 1. Fungsi Hanya Untuk Menghitung Estimasi Harga (Visual)
        function updateEstimate() {
            if (!roomSelect || !checkInHero || !checkOutHero) return;

            const selectedOption = roomSelect.options[roomSelect.selectedIndex];

            // Reset jika data belum lengkap
            if (!selectedOption.value || !checkInHero.value || !checkOutHero.value) {
                estDisplay.innerText = "Rp 0";
                return;
            }

            const price = parseInt(selectedOption.dataset.price);
            const checkIn = new Date(checkInHero.value);
            const checkOut = new Date(checkOutHero.value);

            // Validasi Tanggal (Check out harus lebih besar dari check in)
            if (checkOut <= checkIn) {
                estDisplay.innerText = "Tanggal Invalid";
                return;
            }

            const diffTime = checkOut - checkIn;
            const nights = diffTime / (1000 * 60 * 60 * 24);
            const total = nights * price;

            estDisplay.innerText = "Rp " + total.toLocaleString('id-ID');
        }

        // 2. Fungsi Untuk Submit / Pindah Halaman (Dipanggil saat tombol diklik)
        function submitBooking() {
            const roomId = roomSelect.value;
            const checkIn = checkInHero.value;
            const checkOut = checkOutHero.value;

            // Validasi Form
            if (!roomId) {
                alert("Silakan pilih tipe kamar terlebih dahulu.");
                return;
            }
            if (!checkIn || !checkOut) {
                alert("Silakan tentukan tanggal Check In dan Check Out.");
                return;
            }
            if (new Date(checkOut) <= new Date(checkIn)) {
                alert("Tanggal Check Out harus setelah Check In.");
                return;
            }

            // Redirect ke Halaman Payment
            // Format URL: /booking/payment/{id}?check_in=...&check_out=...
            const baseUrl = "{{ url('/booking/payment') }}";
            const url = `${baseUrl}/${roomId}?check_in=${checkIn}&check_out=${checkOut}`;

            window.location.href = url;
        }

        // Event Listeners (Agar harga berubah saat input diganti)
        roomSelect.addEventListener('change', updateEstimate);
        checkInHero.addEventListener('change', updateEstimate);
        checkOutHero.addEventListener('change', updateEstimate);
    </script>
@endsection
