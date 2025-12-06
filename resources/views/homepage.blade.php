@extends('layouts.hotel')

@section('content')

    {{-- HERO SECTION --}}
<section class="relative w-full h-screen flex items-center justify-center">
        <img 
            src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=80"
           class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.45]"
>


        <div class="relative z-10 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold drop-shadow-xl tracking-wide">
                Experience Luxury & Comfort
            </h1>
            <p class="mt-4 text-lg opacity-90">
                Relax and enjoy your unforgettable stay at Sunset Hotel
            </p>

            <a href="{{ route('booking') }}"
               class="mt-8 inline-block bg-orange-500 hover:bg-orange-600 
                      text-white font-semibold px-8 py-3 rounded-full shadow-xl 
                      transition-all duration-300">
                Book Now
            </a>
        </div>
    </section>

    {{-- CHOOSE A ROOM --}}
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Section Title --}}
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold">Choose a Room</h2>
                <div class="w-24 h-[2px] bg-orange-500 mx-auto mt-3"></div>
            </div>

            {{-- Room Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

                {{-- Deluxe Room --}}
                <div class="relative shadow-lg rounded-xl overflow-hidden group">
                    <img 
                        src="https://images.unsplash.com/photo-1600585154350-95cbdc632af3?auto=format&fit=crop&w=900&q=70"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                        From $100/night
                    </div>
                    <div class="absolute bottom-0 left-0 w-full bg-black/60 p-5 text-white">
                        <h3 class="font-semibold text-xl">Deluxe Room</h3>
                        <p class="text-sm mt-2 opacity-90">
                            Nyaman, luas, dan elegan dengan pemandangan terbaik.
                        </p>
                    </div>
                </div>

                {{-- Premium Suite --}}
                <div class="relative shadow-lg rounded-xl overflow-hidden group">
                    <img 
                        src="https://images.unsplash.com/photo-1600585154207-4e5dc300b3a0?auto=format&fit=crop&w=900&q=70"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                        From $150/night
                    </div>
                    <div class="absolute bottom-0 left-0 w-full bg-black/60 p-5 text-white">
                        <h3 class="font-semibold text-xl">Premium Suite</h3>
                        <p class="text-sm mt-2 opacity-90">
                            Dilengkapi ruang tamu dan fasilitas eksklusif.
                        </p>
                    </div>
                </div>

                {{-- Executive Suite --}}
                <div class="relative shadow-lg rounded-xl overflow-hidden group">
                    <img 
                        src="https://images.unsplash.com/photo-1600585153936-a7a73f3d6b43?auto=format&fit=crop&w=900&q=70"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                    >
                    <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                        From $200/night
                    </div>
                    <div class="absolute bottom-0 left-0 w-full bg-black/60 p-5 text-white">
                        <h3 class="font-semibold text-xl">Executive Suite</h3>
                        <p class="text-sm mt-2 opacity-90">
                            Ruangan super luas dengan fasilitas VIP.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-6xl mx-auto px-6 flex justify-between">
            <p>© 2025 Sunset Hotel. All Rights Reserved.</p>
            <div class="flex gap-5">
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
                <a href="#" class="hover:text-white">Support</a>
            </div>
        </div>
    </footer>

@endsection