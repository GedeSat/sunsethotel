{{-- 1. Pastikan nama layout sesuai dengan file layout kamu (misal: layouts.app atau layouts.main) --}}
@extends('layouts.hotel') 

@section('content')

<div class="container py-5">
    <div class="row">
        {{-- KOLOM GAMBAR --}}
        <div class="col-md-6">
            {{-- Mengambil gambar dari database (jika ada), kalau tidak ada pakai gambar default --}}
            <img src="{{ $room->image ?? 'https://via.placeholder.com/600x400' }}" 
                 alt="{{ $room->name }}" 
                 class="img-fluid rounded shadow">
        </div>

        {{-- KOLOM INFO KAMAR --}}
        <div class="col-md-6">
            {{-- 2. Tampilkan Nama Kamar --}}
            <h1 class="display-4 font-weight-bold">{{ $room->name }}</h1>
            
            {{-- 3. Tampilkan Tipe Kasur --}}
            <span class="badge badge-primary">{{ $room->type }}</span>

            {{-- 4. Tampilkan Harga (Format Rupiah) --}}
            <h2 class="text-success mt-3">
                Rp {{ number_format($room->price, 0, ',', '.') }} 
                <small class="text-muted" style="font-size: 16px">/ malam</small>
            </h2>

            <hr>

            {{-- 5. Deskripsi (Gunakan Null Coalescing '??' biar gak error kalau kosong) --}}
            <p class="lead">
                {{ $room->description ?? 'Fasilitas lengkap dengan pemandangan indah, cocok untuk liburan Anda.' }}
            </p>

            {{-- FITUR TAMBAHAN (Hardcode dulu gpp) --}}
            <ul class="list-unstyled mt-4">
                <li>✅ Free Wi-Fi</li>
                <li>✅ Breakfast Included</li>
                <li>✅ 24/7 Room Service</li>
            </ul>

            <br>

            {{-- 6. TOMBOL RESERVASI (PENTING!) --}}
            {{-- Tombol ini akan mengirim ID kamar ke halaman booking --}}
            <a href="{{ route('booking', ['room_id' => $room->id]) }}" class="btn btn-lg btn-warning text-white w-100">
                Booking Kamar Ini Sekarang
            </a>
        </div>
    </div>
</div>

@endsection