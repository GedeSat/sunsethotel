{{-- resources/views/admin/rooms/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="flex justify-between mb-6">
  <h2 class="text-2xl font-semibold"></h2>
  <a href="/admin/rooms/create" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">Tambah Kamar</a>
</div>

<div class="bg-white shadow rounded-xl p-6">
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="border-b">
        <th class="p-3">ID</th>
        <th class="p-3">Nama</th>
        <th class="p-3">Tipe</th>
        <th class="p-3">Harga</th>
        <th class="p-3">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rooms as $room)
      <tr class="border-b hover:bg-gray-50">
        <td class="p-3">{{ $room->id }}</td>
        <td class="p-3">{{ $room->name }}</td>
        <td class="p-3">{{ $room->type }}</td>
        <td class="p-3">Rp{{ number_format($room->price,0,',','.') }}</td>
        <td class="p-3 flex gap-2">
          <a href="/admin/rooms/{{ $room->id }}/edit" class="px-3 py-1 bg-blue-500 text-black rounded hover:bg-blue-600">Edit</a>
          <form action="/admin/rooms/{{ $room->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1 bg-red-500 text-black rounded hover:bg-red-600" onclick="return confirm('Hapus kamar ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- PREVIEW CARD VIEW (FRONTEND STYLE) --}}
<h2 class="text-2xl font-semibold mt-16 mb-8">
    Preview Tampilan Website (Klik untuk Edit)
</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

@foreach ($rooms as $room)
    <a href="{{ route('rooms.edit', $room->id) }}"
       class="group relative block shadow-lg rounded-xl overflow-hidden">

        {{-- GAMBAR --}}
        <img 
            src="{{ $room->image 
                    ? asset('storage/'.$room->image) 
                    : 'https://via.placeholder.com/600x400?text=No+Image' }}"
            class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
        >

        {{-- HARGA --}}
        <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
            Rp{{ number_format($room->price,0,',','.') }}/night
        </div>

        {{-- INFO --}}
        <div class="absolute bottom-0 left-0 w-full bg-black/60 p-5 text-white">
            <h3 class="font-semibold text-xl">{{ $room->name }}</h3>
            <p class="text-sm mt-1 opacity-90">{{ $room->type }}</p>
        </div>

        {{-- BADGE ADMIN --}}
        <div class="absolute top-3 right-3 bg-orange-500 text-white text-xs px-3 py-1 rounded-full">
            Edit
        </div>

    </a>
@endforeach

</div>


@endsection

