@extends('layouts.hotel')

@section('content')

    {{-- HERO BOOKING SECTION --}}
    <section class="relative w-full h-[60vh] flex items-center justify-center bg-gradient-to-b from-orange-600/90 via-orange-700/80 to-gray-900/90">

        {{-- Background Image --}}
        <img 
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=60"
            class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-60">

        {{-- Glow --}}
        <div class="absolute top-10 w-80 h-80 bg-orange-500/40 blur-[120px] rounded-full"></div>

        {{-- Booking Card --}}
        <div class="relative z-20 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-xl p-8 w-[90%] md:w-[700px]">
            <h2 class="text-center text-3xl font-bold text-white mb-6 tracking-wide">
                Booking Hotel
            </h2>

            <form method="POST" action="{{ route('booking') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
                @csrf

                {{-- Pilih Kamar --}}
                <div class="md:col-span-3">
                    <label class="block mb-1 text-sm font-medium">Pilih Kamar</label>
                    <select name="room_id" class="w-full rounded-lg bg-white/20 border border-white/30 p-3 text-black">
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">
                                {{ $room->name }} - {{ $room->type }} (Rp{{ $room->price }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Check In --}}
                <div>
                    <label class="block mb-1 text-sm font-medium">Check In</label>
                    <input type="date" name="check_in" required 
                        class="w-full rounded-lg bg-white/20 border border-white/30 p-3 text-black">
                </div>

                {{-- Check Out --}}
                <div>
                    <label class="block mb-1 text-sm font-medium">Check Out</label>
                    <input type="date" name="check_out" required 
                        class="w-full rounded-lg bg-white/20 border border-white/30 p-3 text-black">
                </div>

                {{-- Submit --}}
                <div class="flex items-end">
                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg p-3 transition-all">
                        Booking
                    </button>
                </div>

            </form>
        </div>
    </section>

    {{-- RIWAYAT BOOKING --}}
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="text-2xl font-bold mb-6">Riwayat Booking</h2>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="p-3 font-semibold">Kamar</th>
                            <th class="p-3 font-semibold">Check In</th>
                            <th class="p-3 font-semibold">Check Out</th>
                            <th class="p-3 font-semibold">Total harga</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bookings as $booking)
                        <tr class="border-t">
                            <td class="p-3">
                                @if($booking->room)
                                    {{ $booking->room->name }}
                                @else
                                    <em class="text-red-500">Kamar tidak ditemukan</em>
                                @endif
                            </td>
                            <td class="p-3">{{ $booking->check_in }}</td>
                            <td class="p-3">{{ $booking->check_out }}</td>
                            <td class="p-3">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </section>

@endsection
