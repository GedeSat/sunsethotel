@extends('layouts.hotel')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-28 pb-20 bg-gradient-to-b from-slate-50 via-white to-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14" data-aos="fade-up">
            <span class="px-4 py-1.5 bg-orange-100 text-orange-600 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">The Peak of Luxury</span>
            <h1 class="text-4xl md:text-5xl font-bold text-orange-600">Executive Suite</h1>
            <div class="h-1 w-24 bg-orange-400 mx-auto mt-4 rounded-full"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                Pengalaman menginap tak terlupakan dengan fasilitas lengkap, area kerja luas, dan kenyamanan setingkat apartemen pribadi.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="space-y-4" data-aos="fade-right">
                <div class="relative group overflow-hidden rounded-3xl shadow-2xl">
                    <img id="mainHeroImage" 
                        src="https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&w=1200&q=80" 
                        class="w-full h-[450px] object-cover transition-all duration-500 ease-in-out">
                    <div class="absolute bottom-5 left-5 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-xl">
                        <p id="imageCaption" class="text-orange-600 font-bold text-sm">Main Bedroom Area</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <img src="https://images.unsplash.com/photo-1590490359683-658d3d23f972?auto=format&fit=crop&w=600&q=80" 
                        onclick="changeImage(this.src, 'Main Bedroom Area')" 
                        class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer border-2 border-orange-500 opacity-100 transition-all hover:scale-105">
                    
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80" 
                        onclick="changeImage(this.src, 'Private Executive Lounge')" 
                        class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105">
                    
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=600&q=80" 
                        onclick="changeImage(this.src, 'Luxury Bathtub & Spa')" 
                        class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105">

                    <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=600&q=80" 
                        onclick="changeImage(this.src, 'Work Station & Pantry')" 
                        class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105">
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-8 border border-orange-50" data-aos="fade-left">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">Fasilitas Eksekutif</h2>
                
                <div class="grid grid-cols-2 gap-y-6 mb-10">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-expand text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">65 sqm Room Size</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-couch text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">Living Area</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-laptop-code text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">Work Station</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-hot-tub-person text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">Private Jacuzzi</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-coffee text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">Nespresso Machine</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-wind text-orange-500 w-5"></i>
                        <span class="text-sm font-medium">Air Purifier</span>
                    </div>
                </div>

                <div class="mb-8 p-6 bg-orange-600 rounded-3xl text-white shadow-2xl transform hover:scale-105 transition-transform">
                    <p class="text-orange-200 text-sm font-medium">Investment in Comfort</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <h3 class="text-4xl font-bold">Rp 1.500.000</h3>
                        <span class="text-orange-200">/ night</span>
                    </div>
                    <p class="mt-4 text-xs text-orange-100 opacity-80">* Termasuk Sarapan untuk 2 Orang & Akses Gym</p>
                </div>

                <a href="/booking"
                    class="group relative overflow-hidden block w-full text-center py-5 rounded-2xl bg-orange-500 text-white font-bold text-xl transition-all shadow-lg shadow-orange-200 hover:shadow-orange-400">
                    <span class="relative z-10">Booking Executive Suite</span>
                    <div class="absolute inset-0 bg-orange-700 transform translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    function changeImage(src, caption) {
        const hero = document.getElementById('mainHeroImage');
        const cap = document.getElementById('imageCaption');
        const thumbs = document.querySelectorAll('.thumb-img');
        
        // Animasi transisi
        hero.style.opacity = '0.3';
        hero.style.transform = 'scale(1.02)';
        
        setTimeout(() => {
            hero.src = src;
            cap.innerText = caption;
            hero.style.opacity = '1';
            hero.style.transform = 'scale(1)';
        }, 200);

        // Update visual thumbnail aktif
        thumbs.forEach(img => {
            img.classList.remove('border-2', 'border-orange-500', 'opacity-100');
            img.classList.add('opacity-60');
        });
        event.target.classList.add('border-2', 'border-orange-500', 'opacity-100');
        event.target.classList.remove('opacity-60');
    }
</script>
@endsection