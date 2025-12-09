@extends('layouts.admin')



@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6">

        {{-- Total Booking --}}
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Booking</p>
            <p class="text-3xl font-bold mt-2">{{ $totalBookings }}</p>
        </div>

        {{-- Kamar Tersedia --}}
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Kamar Tersedia</p>
            <p class="text-3xl font-bold mt-2">{{ $availableRooms }}</p>
        </div>

        {{-- Total User --}}
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total User</p>
            <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
        </div>

    </div>
</div>
@endsection