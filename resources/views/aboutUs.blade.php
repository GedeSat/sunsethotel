@extends('layouts.hotel')
@section('content')

<!-- HERO SECTION (fix lag + optimized) -->
<section class="relative w-full h-[60vh] overflow-hidden">
    <img 
        src="{{ asset('img/executive suite.jpg') }}" 
        class="w-full h-full object-cover opacity-0 transition-opacity duration-[1200ms] ease-out fade-image"
        alt="Sunset Hotel"
    >

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 flex items-center justify-center h-full">
        <h1 class="text-white text-5xl md:text-6xl font-semibold">
            About Us
        </h1>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="py-16 bg-white w-full">
    <div class="max-w-5xl mx-auto px-6 md:px-12 lg:px-16 text-gray-700 space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div>
                <div class="w-16 h-1 bg-[#c57b66] mb-8"></div>
                <h2 class="text-5xl font-light text-gray-800 mb-8">
                    A place to remember
                </h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Donec malesuada lorem maximus mauris scelerisque.
                </p>
                <p class="text-gray-600 leading-relaxed mb-10">
                    Ut ac ligula sapien. Suspendisse cursus faucibus finibus.
                    Nunc vel eros ligula. Sed commodo eros vitae.
                </p>
            </div>

            <div>
                <img 
                    src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?cs=srgb&dl=pexels-pixabay-258154.jpg&fm=jpg"
                    class="rounded shadow-md w-full object-cover"
                    alt="About Image"
                    loading="lazy"
                >
            </div>

        </div>
    </div>
</section>

<!-- PARALLAX MILESTONES (smooth di mobile) -->
<section 
    class="relative w-full bg-center bg-cover py-24 text-white md:bg-fixed"
    style="background-image: url('{{ asset('img/pantai.jpg') }}');"
>
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-5xl mx-auto text-center px-6">

        <div class="mb-8">
            <div class="w-16 h-1 bg-[#d9987e] mx-auto mb-4"></div>
            <h2 class="text-4xl md:text-5xl font-semibold">Our Milestones</h2>
        </div>

        <p class="text-gray-300 max-w-3xl mx-auto leading-relaxed mb-16">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <div class="bg-black/40 border border-[#d9987e] px-8 py-10 text-center rounded-lg">
                <i class="fa-solid fa-martini-glass-citrus text-[#d9987e] text-5xl mb-4"></i>
                <h3 class="text-4xl font-bold counter" data-target="231">0</h3>
                <p class="text-sm mt-2 text-gray-300">Cocktails/day</p>
            </div>

            <div class="bg-black/40 border border-[#d9987e] px-8 py-10 text-center rounded-lg">
                <i class="fa-solid fa-water-ladder text-[#d9987e] text-5xl mb-4"></i>
                <h3 class="text-4xl font-bold counter" data-target="3">0</h3>
                <p class="text-sm mt-2 text-gray-300">Pools</p>
            </div>

            <div class="bg-black/40 border border-[#d9987e] px-8 py-10 text-center rounded-lg">
                <i class="fa-solid fa-building text-[#d9987e] text-5xl mb-4"></i>
                <h3 class="text-4xl font-bold counter" data-target="79">0</h3>
                <p class="text-sm mt-2 text-gray-300">Rooms</p>
            </div>

            <div class="bg-black/40 border border-[#d9987e] px-8 py-10 text-center rounded-lg">
                <i class="fa-solid fa-couch text-[#d9987e] text-5xl mb-4"></i>
                <h3 class="text-4xl font-bold counter" data-target="25">0</h3>
                <p class="text-sm mt-2 text-gray-300">Apartments</p>
            </div>

        </div>
    </div>
</section>

<!-- OUR HOTEL LIST -->
<section class="py-20">
    <div class="max-w-6xl mx-auto px-5">
        
        <h2 class="text-center text-4xl font-semibold text-gray-800 mb-12">
            Our Hotel
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">

            <ul class="space-y-5">
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Donec malesuada lorem maximus mauris
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Integer tempus ligula sem, id feugiat
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Malesuada lorem maximus mauris sceleri
                </li>
            </ul>

            <ul class="space-y-5">
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Tempus ligula sem, id feugiat quam
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Integer tempus ligula sem, id feugiat
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Eusuada lorem maximus mauris sceleri
                </li>
            </ul>

            <ul class="space-y-5">
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Tempus ligula sem, id feugiat quam
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Integer tempus ligula sem, id feugiat
                </li>
                <li class="flex items-start gap-3">
                    <span class="bg-[#d99b7c] text-white p-1.5 rounded-full">✔</span>
                    Eusuada lorem maximus mauris sceleri
                </li>
            </ul>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <img src="{{ asset('img/hotel-1.jpg') }}" class="w-full h-[350px] object-cover rounded-lg shadow-lg" loading="lazy">
            <img src="{{ asset('img/hotel-2.jpg') }}" class="w-full h-[350px] object-cover rounded-lg shadow-lg" loading="lazy">
            <img src="{{ asset('img/hotel-3.jpg') }}" class="w-full h-[350px] object-cover rounded-lg shadow-lg" loading="lazy">
        </div>

    </div>
</section>

<!-- COUNTER SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".counter");

    const startCounting = (counter) => {
        const target = +counter.dataset.target;
        const duration = 1500;
        let start = null;

        const step = (timestamp) => {
            if (!start) start = timestamp;
            const progress = Math.min((timestamp - start) / duration, 1);
            counter.textContent = Math.floor(progress * target);

            if (progress < 1) requestAnimationFrame(step);
            else counter.textContent = target;
        };

        requestAnimationFrame(step);
    };

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounting(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.6 });

    counters.forEach(counter => observer.observe(counter));
});
document.addEventListener('DOMContentLoaded', () => {
    const img = document.querySelector('.fade-image');

    // tunggu 50ms agar CSS sudah ter-render
    setTimeout(() => {
        img.classList.remove('opacity-0');
    }, 50);
});
</script>

@endsection
