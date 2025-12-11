@extends('layouts.hotel')

@section('content')

<!-- SWIPER -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* Mencegah efek putih pada pergantian slide */
    .swiper {
        background: #000 !important;
    }
    .swiper-slide {
        opacity: 0 !important;
        transition: opacity 1.2s ease-in-out !important;
    }
    .swiper-slide-active {
        opacity: 1 !important;
    }
</style>

<section class="swiper heroSwiper w-full h-screen">
  <div class="swiper-wrapper">

    <!-- Slide 1 -->
    <div class="swiper-slide w-full h-screen relative">
      <img 
        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1800&q=80"
        class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.45] -z-10"
        preload="auto"
      >
      <div class="flex items-center justify-center h-full">
        <div class="text-center text-white">
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
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="swiper-slide w-full h-screen relative">
      <img 
        src="{{ asset('img/executive suite.jpg') }}"
        class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.45] -z-10"
        preload="auto"
      >
      <div class="flex items-center justify-center h-full">
        <div class="text-center text-white">
          <h1 class="text-5xl md:text-6xl font-bold drop-shadow-xl tracking-wide">
            Premium Suite
          </h1>
          <p class="mt-4 text-lg opacity-90">
            Spacious, elegant, and perfect for your holiday.
          </p>
           <a href="{{ route('booking') }}"
             class="mt-8 inline-block bg-orange-500 hover:bg-orange-600 
                    text-white font-semibold px-8 py-3 rounded-full shadow-xl 
                    transition-all duration-300">
            Book Now
          </a>
        </div>
      </div>
    </div>

  </div>
</section>


<script>
const swiper = new Swiper(".heroSwiper", {
    loop: true,
    speed: 500,
    effect: "fade",
    fadeEffect: {
        crossFade: true,
    },
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    allowTouchMove: false,
});
</script>


{{-- SECTION ROOM DST TETAP SAMA --}}
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
                    src="{{ asset('img/kamar deluxe.jpeg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.700k/night
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
                    src="{{ asset('img/premium suite.jpg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.1.000k/night
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
                    src="{{ asset('img/executive suite.jpg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.1.500k/night
                </div>
                <div class="absolute bottom-0 left-0 w-full bg-black/60 p-5 text-white">
                    <h3 class="font-semibold text-xl">Executive Suite</h3>
                    <p class="text-sm mt-2 opacity-90">
                        Ruangan super luas dengan fasilitas VIP.
                    </p>
                </div>
            </div>

            {{-- Deluxe Room --}}
            <div class="relative shadow-lg rounded-xl overflow-hidden group">
                <img 
                    src="{{ asset('img/kamar deluxe.jpeg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.700k/night
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
                    src="{{ asset('img/premium suite.jpg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.1.000k/night
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
                    src="{{ asset('img/executive suite.jpg') }}"
                    class="w-full h-72 object-cover group-hover:scale-105 transition duration-500"
                >
                <div class="absolute top-3 left-3 bg-black/80 text-white text-sm px-3 py-1 rounded">
                    From Rp.1.500k/night
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

@endsection
