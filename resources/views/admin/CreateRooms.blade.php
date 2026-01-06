@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-semibold mb-6">Tambah Kamar</h2>

@if (session('success'))
<div 
    id="successAlert"
    class="fixed top-6 right-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg
           animate-slide-in">
    ✅ {{ session('success') }}
</div>
@endif

<form 
    action="/admin/rooms" 
    method="POST" 
    enctype="multipart/form-data"
    class="bg-white p-6 rounded-xl shadow w-full max-w-lg"
>
    @csrf

    <label class="block mb-2 font-medium">Nama Kamar</label>
    <input 
        type="text" 
        name="name" 
        class="w-full p-3 border rounded mb-4"
        required
    >

    <label class="block mb-2 font-medium">Tipe</label>
    <select 
        name="type" 
        class="w-full p-3 border rounded mb-4"
        required
    >
        <option value="deluxe">Deluxe</option>
        <option value="suite">Suite</option>
        <option value="premium">Premium</option>
    </select>

    <label class="block mb-2 font-medium">Harga</label>
    <input 
        type="number" 
        name="price" 
        class="w-full p-3 border rounded mb-4"
        required
    >

    {{-- UPLOAD GAMBAR --}}
    <label class="block mb-2 font-medium">Gambar Kamar</label>
    <input 
        type="file" 
        name="image" 
        accept="image/*"
        class="w-full p-3 border rounded mb-6"
        required
    >

    <button class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">
        Simpan
    </button>
</form>
@endsection
<script>
    setTimeout(() => {
        const alert = document.getElementById('successAlert');
        if (alert) alert.remove();
    }, 2500);
</script>