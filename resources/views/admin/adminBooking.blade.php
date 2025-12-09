@extends('layouts.admin')

@section('content')
<div class="px-6 py-5">
    <h1 class="text-2xl font-bold mb-6">Daftar Booking</h1>

    <div class="overflow-x-auto bg-white  shadow rounded-lg">
        <table class="w-full divide-y divide-gray-200 shadow-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kamar</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Check In</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Check Out</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Total Harga</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($bookings as $booking)
                <tr>
                    <td class="px-4 py-3">
                        {{ $booking->user->name ?? 'User tidak ditemukan' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $booking->room->name ?? 'Kamar tidak ditemukan' }}
                    </td>
                    <td class="px-4 py-3">{{ $booking->check_in }}</td>
                    <td class="px-4 py-3">{{ $booking->check_out }}</td>
                    <td class="px-4 py-3">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection