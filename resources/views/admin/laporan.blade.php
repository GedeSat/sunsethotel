@extends('layouts.admin')

@section('content')

<div class="mt-8 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
        <i class="fa-solid fa-envelope text-orange-500"></i> Pesan Masuk Terbaru
    </h3>

    {{-- Gunakan $contacts di sini --}}
    @if($contacts->isEmpty())
        <p class="text-gray-500 italic">Belum ada pesan masuk.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- PERBAIKAN: Ubah $messages menjadi $contacts --}}
                    @foreach($contacts as $msg)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $msg->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $msg->name }}</td>
                        <td class="px-4 py-3">{{ $msg->email }}</td>
                        <td class="px-4 py-3">
                            {{-- Pastikan kolom subject ada di database, jika tidak ada hapus baris ini --}}
                            {{ Str::limit($msg->message, 50) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection