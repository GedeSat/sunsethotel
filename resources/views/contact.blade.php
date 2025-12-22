@extends('layouts.hotel')

@section('content')

    <section class="relative bg-gradient-to-br from-orange-50 via-white to-orange-100">
        <!-- Header -->
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Contact <span class="text-orange-600">Sunset Hotel</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Kami siap membantu reservasi, pertanyaan, maupun kebutuhan khusus Anda.
            </p>
        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto px-6 pb-24 grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Info -->
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
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition"><i class="fa-brands fa-instagram text-2xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition"><i class="fa-brands fa-facebook text-2xl"></i></a>
                        <a href="#" class="text-gray-500 hover:text-orange-600 transition"><i class="fa-brands fa-whatsapp text-2xl"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Kirim Pesan</h2>

                <form method="POST" action="#" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" placeholder="Nama lengkap" class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" placeholder="email@example.com" class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                        <textarea rows="4" placeholder="Tulis pesan Anda..." class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-xl font-medium hover:bg-orange-700 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
