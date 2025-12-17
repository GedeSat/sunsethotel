@extends('layouts.hotel')

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<section class="pt-28 pb-20 bg-gradient-to-b from-cyan-50 via-white to-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14" data-aos="fade-up">
            <span class="px-4 py-1.5 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block shadow-sm">Seaside Serenity</span>
            <h1 class="text-4xl md:text-5xl font-bold text-cyan-800 tracking-tight">Coastal Light Room</h1>
            <div class="h-1.5 w-24 bg-cyan-400 mx-auto mt-4 rounded-full"></div>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-lg leading-relaxed">
                Rasakan kesegaran angin laut dan cahaya alami yang melimpah dalam ruangan yang dirancang untuk ketenangan jiwa.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <div class="space-y-4" data-aos="fade-right">
                <div class="relative group overflow-hidden rounded-[2rem] shadow-2xl border-4 border-white">
                    <img id="mainHeroImage" 
                        src="https://images.pexels.com/photos/279746/pexels-photo-279746.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" 
                        class="w-full h-[480px] object-cover transition-all duration-700 ease-in-out transform hover:scale-105">
                    <div class="absolute bottom-6 left-6 bg-white/60 backdrop-blur-md px-5 py-2 rounded-2xl border border-white/20">
                        <p id="imageCaption" class="text-cyan-900 font-bold text-sm tracking-wide uppercase">Coastal Bedding Area</p>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    <img src="https://images.pexels.com/photos/279746/pexels-photo-279746.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Coastal Bedding Area')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer border-2 border-cyan-500 opacity-100 transition-all hover:scale-110 shadow-lg">
                    
                    <img src="https://images.pexels.com/photos/3232535/pexels-photo-3232535.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Private Balcony View')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-110 shadow-lg">
                    
                    <img src="https://images.pexels.com/photos/3285196/pexels-photo-3285196.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Bright Modern Bathroom')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-110 shadow-lg">

                    <img src="https://images.pexels.com/photos/1139785/pexels-photo-1139785.jpeg?auto=compress&cs=tinysrgb&w=600" 
                        onclick="changeImage(this.src, 'Light & Airy Lounge')" 
                        class="thumb-img rounded-2xl object-cover h-24 w-full cursor-pointer opacity-60 hover:opacity-100 transition-all hover:scale-110 shadow-lg">
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl p-10 border border-cyan-50 relative overflow-hidden" data-aos="fade-left">
                <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-100/50 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Fasilitas Deluxe</h2>
                
                <div class="grid grid-cols-2 gap-y-6 mb-12">
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-bed text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">King Size Bed</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-wifi text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Free Wi-Fi</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-tv text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Smart TV 50"</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-snowflake text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Full AC</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-mug-hot text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Mini Bar</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-500 transition-colors">
                            <i class="fa-solid fa-bath text-cyan-600 group-hover:text-white"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Modern Bath</span>
                    </div>
                </div>

                <div class="mb-10 p-8 bg-gradient-to-r from-cyan-600 to-blue-700 rounded-3xl text-white shadow-xl relative group">
                    <p class="text-cyan-200 text-sm font-semibold tracking-wider uppercase">Best Value Guaranteed</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-4xl font-black">Rp 850.000</span>
                        <span class="text-cyan-100 font-light">/ malam</span>
                    </div>
                </div>

                <a href="/booking"
                    class="group relative overflow-hidden block w-full text-center py-5 rounded-2xl bg-cyan-600 text-white font-extrabold text-xl transition-all shadow-lg hover:shadow-cyan-200">
                    <span class="relative z-10 flex items-center justify-center gap-3">
                        PESAN SEKARANG <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </span>
                    <div class="absolute inset-0 bg-cyan-700 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
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
        
        // Animasi transisi halus (Fade + Zoom)
        hero.style.opacity = '0';
        hero.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            hero.src = src;
            cap.innerText = caption.toUpperCase();
            hero.style.opacity = '1';
            hero.style.transform = 'scale(1)';
        }, 300);

        // Update thumbnail active state
        thumbs.forEach(img => {
            img.classList.remove('border-2', 'border-cyan-500', 'opacity-100', 'scale-110');
            img.classList.add('opacity-60');
        });
        
        const clickedThumb = event.currentTarget;
        clickedThumb.classList.add('border-2', 'border-cyan-500', 'opacity-100', 'scale-110');
        clickedThumb.classList.remove('opacity-60');
    }
</script>
@endsection