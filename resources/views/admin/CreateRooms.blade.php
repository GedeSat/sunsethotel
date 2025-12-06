@extends('layouts.admin')


@section('content')
<h2 class="text-2xl font-semibold mb-6">Tambah Kamar</h2>


<form action="/admin/rooms" method="POST" class="bg-white p-6 rounded-xl shadow w-full max-w-lg">
@csrf


<label class="block mb-2 font-medium">Nama Kamar</label>
<input type="text" name="name" class="w-full p-3 border rounded mb-4">


<label class="block mb-2 font-medium">Tipe</label>
<input type="text" name="type" class="w-full p-3 border rounded mb-4">


<label class="block mb-2 font-medium">Harga</label>
<input type="number" name="price" class="w-full p-3 border rounded mb-4">


<button class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Simpan</button>
</form>
@endsection