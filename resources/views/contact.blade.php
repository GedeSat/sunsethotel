@extends('layouts.hotel')

@section('content')

    {{-- Menampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <section class="relative bg-gradient-to-br from-orange-50 via-white to-orange-100">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Contact <span class="text-orange-600">Sunset Hotel</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kami siap membantu reservasi, pertanyaan, maupun kebutuhan khusus Anda.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-6 pb-24 grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800">Informasi Kontak</h2>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-location-dot text-orange-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-700">Alamat</p>
                        <p class="text-gray-600">Jl. Sunset Beach No. 21, Bali, Indonesia</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-phone text-orange-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-700">Telepon</p>
                        <p class="text-gray-600">+62 812 3456 7890</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <i class="fa-solid fa-envelope text-orange-600 text-xl mt-1"></i>
                    <div>
                        <p class="font-medium text-gray-700">Email</p>
                        <p class="text-gray-600">info@sunsethotel.com</p>
                    </div>
                </div>

                <div class="pt-4">
                    <p class="font-medium text-gray-700 mb-2">Ikuti Kami</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition">
                            <i class="fa-brands fa-whatsapp text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Kirim Pesan</h2>

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    
                    {{-- Input Nama --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" placeholder="Nama lengkap" required
                            class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" />
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" placeholder="email@example.com" required
                            class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" />
                    </div>
                    {{-- Input Pesan --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea name="message" rows="4" placeholder="Tulis pesan Anda..." required
                            class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500"></textarea>
                    </div>

                    {{-- Tombol Kirim --}}
                    <button type="submit"
                        class="w-full bg-orange-600 text-white py-3 rounded-xl font-medium hover:bg-orange-700 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </section>
@endsection