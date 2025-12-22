@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Edit Kamar</h2>
<form 
    action="{{ route('rooms.update', $room->id) }}" 
    method="POST" 
    enctype="multipart/form-data"
    class="bg-white p-6 rounded-xl shadow w-full max-w-xl"
>
    @csrf
    @method('PUT')

    <label class="block mb-2 font-medium">Nama Kamar</label>
    <input type="text" name="name" value="{{ $room->name }}" class="w-full p-3 border rounded mb-4">

    <label class="block mb-2 font-medium">Slug</label>
    <input type="text" name="slug" value="{{ $room->slug }}" class="w-full p-3 border rounded mb-4">

    <label class="block mb-2 font-medium">Tipe</label>
    <input type="text" name="type" value="{{ $room->type }}" class="w-full p-3 border rounded mb-4">

    <label class="block mb-2 font-medium">Harga</label>
    <input type="number" name="price" value="{{ $room->price }}" class="w-full p-3 border rounded mb-4">

    <label class="block mb-2 font-medium">Deskripsi</label>
    <textarea name="description" class="w-full p-3 border rounded mb-4">{{ $room->description }}</textarea>

    <label class="block mb-2 font-medium">Gambar</label>
    <input type="file" name="image" class="w-full p-3 border rounded mb-4">

    @if($room->image)
        <img src="{{ asset('storage/'.$room->image) }}" class="w-40 rounded mb-4">
    @endif

    <label class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="is_active" value="1" {{ $room->is_active ? 'checked' : '' }}>
        Tampilkan di Homepage
    </label>

    <button class="px-5 py-2 bg-orange-500 text-white rounded">
        Update
    </button>


</form>

    <label class="block mb-2 font-medium">Gallery Kamar</label>

    <input type="file" 
        name="gallery[]" 
        multiple
        class="w-full p-3 border rounded mb-4">

    @if($room->gallery)
        <div class="grid grid-cols-4 gap-4 mb-4">
            @foreach($room->gallery as $img)
                <img src="{{ asset('storage/'.$img) }}"
                    class="rounded shadow h-24 object-cover">
            @endforeach
        </div>
    @endif

@endsection