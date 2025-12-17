@extends('layouts.hotel')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-28 pb-20 bg-gradient-to-b from-orange-50 via-white to-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-bold text-orange-600">Deluxe Room</h1>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Nikmati kenyamanan premium dengan sentuhan hangat matahari senja khas Sunset Hotel.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="space-y-4" data-aos="fade-right">
                <div class="relative group overflow-hidden rounded-3xl shadow-2xl">
                    <img id="mainHeroImage" 
                        src="https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&fm=webp" 
                        class="w-full h-[420px] object-cover transition-all duration-500 ease-in-out transform">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-all"></div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <img src="https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg?auto=compress&cs=tinysrgb&fm=webp" 
                        onclick="changeImage(this.src)" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer border-2 border-orange-500 opacity-100 transition-all hover:scale-105">
                    
                    <img src="https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&fm=webp" 
                        onclick="changeImage(this.src)" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105">
                    
                    <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1600&q=80" 
                        onclick="changeImage(this.src)" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105">
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-8 border border-orange-50" data-aos="fade-left">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">Detail Kamar</h2>
                
                <p class="text-gray-600 mb-6 leading-relaxed italic">
                    "Kemewahan dalam setiap detail, kehangatan dalam setiap sudut."
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-orange-50 transition-all group">
                        <i class="fa-solid fa-bed text-orange-500 group-hover:bounce"></i>
                        <span class="text-sm font-medium">King Size Bed</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-orange-50 transition-all group">
                        <i class="fa-solid fa-wifi text-orange-500 group-hover:bounce"></i>
                        <span class="text-sm font-medium">Wi‑Fi Gratis</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-orange-50 transition-all group">
                        <i class="fa-solid fa-tv text-orange-500 group-hover:bounce"></i>
                        <span class="text-sm font-medium">Smart TV</span>
                    </div>
                    <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-orange-50 transition-all group">
                        <i class="fa-solid fa-snowflake text-orange-500 group-hover:bounce"></i>
                        <span class="text-sm font-medium">Full AC</span>
                    </div>
                </div>

                <div class="mb-8 p-6 bg-orange-600 rounded-2xl text-white shadow-lg shadow-orange-200">
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="text-orange-200 text-sm">Harga Spesial</span>
                            <h3 class="text-4xl font-bold mt-1">Rp 700.000</h3>
                        </div>
                        <span class="text-sm">/ Malam</span>
                    </div>
                </div>

                <a href="/booking"
                    class="group relative overflow-hidden block w-full text-center py-4 rounded-full bg-orange-500 text-white font-bold text-lg transition-all">
                    <span class="relative z-10">Reservasi Sekarang</span>
                    <div class="absolute inset-0 bg-orange-700 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // 1. Inisialisasi Animasi Scroll (AOS)
    AOS.init({
        duration: 1000,
        once: true
    });

    // 2. Fungsi Ganti Gambar (Gallery)
    function changeImage(src) {
        const hero = document.getElementById('mainHeroImage');
        const thumbs = document.querySelectorAll('.thumb-img');
        
        // Animasi fade out
        hero.style.opacity = '0';
        hero.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            hero.src = src;
            // Animasi fade in
            hero.style.opacity = '1';
            hero.style.transform = 'scale(1)';
        }, 300);

        // Update border thumbnail
        thumbs.forEach(img => {
            img.classList.remove('border-2', 'border-orange-500', 'opacity-100');
            img.classList.add('opacity-60');
        });
        event.target.classList.add('border-2', 'border-orange-500', 'opacity-100');
        event.target.classList.remove('opacity-60');
    }
</script>

<style>
    .bounce { animation: bounce 0.5s infinite alternate; }
    @keyframes bounce {
        from { transform: translateY(0); }
        to { transform: translateY(-4px); }
    }
</style>
@endsection