@extends('layouts.hotel')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-28 pb-20 bg-gradient-to-b from-gray-50 via-white to-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14" data-aos="fade-up">
            <span class="px-4 py-1.5 bg-orange-100 text-orange-600 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">Exclusive Experience</span>
            <h1 class="text-4xl md:text-5xl font-bold text-orange-600">Premium Suite</h1>
            <div class="h-1 w-24 bg-orange-400 mx-auto mt-4 rounded-full"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                Definisi kemewahan sejati dengan ruang tamu pribadi, fasilitas eksklusif, dan pemandangan kota yang memukau.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

         <div class="space-y-4" data-aos="fade-right">
    <div class="relative group overflow-hidden rounded-3xl shadow-2xl">
        <img id="mainHeroImage" 
            src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=1200&q=80" 
            class="w-full h-[450px] object-cover transition-all duration-500 ease-in-out transform">
    </div>

    <div class="grid grid-cols-4 gap-4">
        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?auto=format&fit=crop&w=600&q=80" 
            onclick="changeImage(this.src)" 
            class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer border-2 border-orange-500 opacity-100 transition-all hover:scale-105 shadow-md"
            title="Bedroom Area">
        
        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=600&q=80" 
            onclick="changeImage(this.src)" 
            class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md"
            title="Private Lounge">
        
        <img src="https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?auto=format&fit=crop&w=600&q=80" 
            onclick="changeImage(this.src)" 
            class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md"
            title="Luxury Bathroom">

        <img src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=600&q=80" 
            onclick="changeImage(this.src)" 
            class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md"
            title="Work & Coffee Space">
    </div>
</div>

            <div class="bg-white rounded-3xl shadow-xl p-8 border border-orange-50" data-aos="fade-left">
                <h2 class="text-3xl font-semibold text-gray-800 mb-4">Detail & Fasilitas</h2>
                
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Premium Suite menawarkan kenyamanan tak tertandingi dengan interior modern-klasik. Cocok bagi Anda yang menghargai privasi dan layanan kelas atas.
                </p>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-10">
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-bed text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Super King Bed</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-couch text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Private Lounge</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-wifi text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">High Speed Wi-Fi</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-bath text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Jacuzzi & Bathtub</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-utensils text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Breakfast in Room</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-tv text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">65" 4K Smart TV</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-wine-glass text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Premium Mini Bar</span>
                    </div>
                    <div class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50 group-hover:bg-orange-500 transition-all">
                            <i class="fa-solid fa-shield-halved text-orange-500 group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Safe Deposit Box</span>
                    </div>
                </div>

                <div class="mb-8 p-6 bg-gray-900 rounded-3xl text-white shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-500/20 rounded-full blur-3xl group-hover:bg-orange-500/40 transition-all"></div>
                    <div class="flex justify-between items-center relative z-10">
                        <div>
                            <span class="text-gray-400 text-sm">Harga Per Malam</span>
                            <div class="flex items-center gap-2">
                                <h3 class="text-3xl font-bold text-orange-500">Rp 1.000.000</h3>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs bg-orange-500 px-2 py-1 rounded text-white font-bold animate-pulse">BEST VALUE</span>
                        </div>
                    </div>
                </div>

                <a href="/booking"
                    class="group relative overflow-hidden block w-full text-center py-5 rounded-2xl bg-orange-500 text-white font-bold text-xl transition-all shadow-lg shadow-orange-200">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        Reservasi Sekarang <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-orange-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    function changeImage(src) {
        const hero = document.getElementById('mainHeroImage');
        const thumbs = document.querySelectorAll('.thumb-img');
        
        hero.style.opacity = '0.5';
        hero.style.filter = 'blur(4px)';
        
        setTimeout(() => {
            hero.src = src;
            hero.style.opacity = '1';
            hero.style.filter = 'blur(0px)';
        }, 250);

        thumbs.forEach(img => {
            img.classList.remove('border-2', 'border-orange-500', 'opacity-100');
            img.classList.add('opacity-60');
        });
        event.target.classList.add('border-2', 'border-orange-500', 'opacity-100');
        event.target.classList.remove('opacity-60');
    }
</script>
@endsection