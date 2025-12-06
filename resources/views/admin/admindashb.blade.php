@extends('layouts.admin')

@section('content')

<div class="grid md:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
        <p class="text-gray-500 text-sm">Total Booking</p>
        <p class="text-3xl font-bold mt-2">120</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
        <p class="text-gray-500 text-sm">Kamar Tersedia</p>
        <p class="text-3xl font-bold mt-2">32</p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg transition">
        <p class="text-gray-500 text-sm">Total User</p>
        <p class="text-3xl font-bold mt-2">58</p>
    </div>

</div>

@endsection
