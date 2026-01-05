@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
            <p class="text-gray-500 mt-1">Buat akun baru untuk Staff atau Pengunjung.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="text-gray-600 hover:text-orange-500 font-medium transition duration-200 flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-3xl mx-auto border border-gray-100">
        
        <div class="bg-orange-50 px-6 py-4 border-b border-orange-100 flex items-center gap-3">
            <div class="bg-orange-100 p-2 rounded-full text-orange-600">
                <i class="fa-solid fa-user-plus text-xl"></i>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Formulir Pendaftaran</h2>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-regular fa-id-card text-gray-400"></i>
                        </div>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition duration-200 @error('name') border-red-500 @enderror" 
                               placeholder="Contoh: Budi Santoso" required>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition duration-200 @error('email') border-red-500 @enderror" 
                               placeholder="nama@email.com" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role (Hak Akses)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-shield-halved text-gray-400"></i>
                        </div>
                        <select name="role" id="role" 
                                class="pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 shadow-sm cursor-pointer">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Tamu)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola)</option>
                        </select>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Admin memiliki akses penuh ke sistem.</p>
                </div>

                <div class="col-span-2 border-t border-gray-100 my-2"></div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition duration-200 @error('password') border-red-500 @enderror" 
                               placeholder="******" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Ulangi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-check-double text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 shadow-sm transition duration-200" 
                               placeholder="******" required>
                    </div>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200 flex items-center gap-2">
                    <i class="fa-solid fa-save"></i> Simpan User
                </button>
            </div>

        </form>
    </div>
</div>
@endsection