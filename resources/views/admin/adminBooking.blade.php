@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-orange-50/30 px-6 py-8">
    
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">
                🌅 Daftar Booking
            </h1>
            <p class="text-gray-500 text-sm mt-1">Kelola reservasi tamu Sunset Hotel</p>
        </div>
        
        <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-orange-100">
            <span class="text-xs text-gray-500 uppercase font-semibold">Total Reservasi</span>
            <div class="text-xl font-bold text-orange-600">{{ $bookings->count() }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-orange-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <thead>
                    <tr class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-left">
                        <th class="px-6 py-4 font-bold text-sm tracking-wider">Tamu</th>
                        <th class="px-6 py-4 font-bold text-sm tracking-wider">Kamar</th>
                        <th class="px-6 py-4 font-bold text-sm tracking-wider">Check In</th>
                        <th class="px-6 py-4 font-bold text-sm tracking-wider">Check Out</th>
                        <th class="px-6 py-4 font-bold text-sm tracking-wider text-right">Total Harga</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-orange-100">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold border border-orange-200">
                                    {{ substr($booking->user->name ?? '?', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ $booking->user->name ?? 'User Hilang' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $booking->user->email ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                🛏️ {{ $booking->room->name ?? 'Unknown Room' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $booking->check_in }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $booking->check_out }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <div class="text-sm font-bold text-gray-800">
                                Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-orange-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <p class="text-lg font-medium">Belum ada booking saat ini.</p>
                                <p class="text-sm text-gray-400">Data reservasi akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <span class="text-xs text-gray-500">Menampilkan seluruh data reservasi</span>
        </div>
    </div>
</div>
@endsection