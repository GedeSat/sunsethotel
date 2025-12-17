@extends('layouts.hotel')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-28 pb-20 bg-gradient-to-b from-amber-50 via-white to-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14" data-aos="fade-up">
            <span class="px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block shadow-sm">Premium Stay</span>
            <h1 class="text-4xl md:text-5xl font-bold text-amber-800 tracking-tight">Golden Horizon Deluxe</h1>
            <div class="h-1.5 w-24 bg-amber-500 mx-auto mt-4 rounded-full"></div>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
                Kemewahan modern dengan pemandangan cakrawala emas yang eksklusif hanya untuk Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="space-y-4" data-aos="fade-right">
                <div class="relative group overflow-hidden rounded-[2rem] shadow-2xl border-4 border-white">
                    <img id="mainHeroImage" 
                        src="https://images.pexels.com/photos/271618/pexels-photo-271618.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                        class="w-full h-[480px] object-cover transition-all duration-700 ease-in-out">
                    
                    <div class="absolute bottom-6 left-6 bg-black/40 backdrop-blur-md px-5 py-2 rounded-2xl border border-white/20">
                        <p id="imageCaption" class="text-white font-medium text-sm tracking-wide uppercase">Golden Horizon Room</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <img src="https://images.pexels.com/photos/271618/pexels-photo-271618.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Golden Horizon Room')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer border-2 border-amber-500 opacity-100 transition-all hover:scale-105 shadow-md">
                    
                    <img src="https://images.pexels.com/photos/1910472/pexels-photo-1910472.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Luxury Marble Bathroom')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md">
                    
                    <img src="https://images.pexels.com/photos/271619/pexels-photo-271619.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Private Lounge Area')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md">

                    <img src="https://images.pexels.com/photos/210158/pexels-photo-210158.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Golden Sunset View')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-105 shadow-md">
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-amber-50 relative overflow-hidden" data-aos="fade-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/50 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Fasilitas Deluxe</h2>
                
                <div class="grid grid-cols-2 gap-y-6 mb-12">
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-bed text-amber-600"></i>
                        <span class="text-gray-700 font-medium">King Size Bed</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-wifi text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Free Wi-Fi</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-tv text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Smart TV 50"</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-snowflake text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Full AC</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-mug-hot text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Mini Bar</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <i class="fa-solid fa-bath text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Modern Bath</span>
                    </div>
                </div>

                <div class="mb-10 p-8 bg-gradient-to-r from-amber-600 to-amber-700 rounded-3xl text-white shadow-xl relative group">
                    <p class="text-amber-200 text-sm font-semibold tracking-wider uppercase">Harga Spesial</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-4xl font-black">Rp 700.000</span>
                        <span class="text-amber-100 font-light">/ malam</span>
                    </div>
                </div>

                <a href="/booking"
                    class="group relative overflow-hidden block w-full text-center py-5 rounded-2xl bg-amber-500 text-white font-extrabold text-xl transition-all shadow-lg hover:shadow-amber-200 active:scale-95">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        RESERVASI SEKARANG <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-amber-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
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
        
        hero.style.opacity = '0.3';
        hero.style.transform = 'scale(0.98)';
        
        setTimeout(() => {
            hero.src = src;
            cap.innerText = caption.toUpperCase();
            hero.style.opacity = '1';
            hero.style.transform = 'scale(1)';
        }, 250);

        thumbs.forEach(img => {
            img.classList.remove('border-2', 'border-amber-500', 'opacity-100');
            img.classList.add('opacity-60');
        });
        
        event.currentTarget.classList.add('border-2', 'border-amber-500', 'opacity-100');
        event.currentTarget.classList.remove('opacity-60');
    }
</script>
@endsection