@extends('layouts.hotel')

@section('content')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <section class="pt-28 pb-20 bg-gradient-to-b from-gray-50 via-white to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            @php
                $gallery = collect($room->gallery);
            @endphp


            {{-- HEADER --}}
            <div class="text-center mb-14" data-aos="fade-up">
                <span
                    class="px-4 py-1.5 bg-orange-100 text-orange-600 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">
                    {{ $room->type }}
                </span>

                <h1 class="text-4xl md:text-5xl font-bold text-orange-600">
                    {{ $room->name }}
                </h1>

                <div class="h-1 w-24 bg-orange-400 mx-auto mt-4 rounded-full"></div>

                <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                    {{ $room->description ?? 'Pengalaman menginap premium dengan fasilitas eksklusif dan kenyamanan maksimal.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">


                {{-- GALERI --}}
                <div class="space-y-4" data-aos="fade-right">
                    <div class="relative group overflow-hidden rounded-3xl shadow-2xl">
                        @if (count($gallery) > 0)
                            <img id="mainHeroImage" src="{{ asset('storage/' . $gallery[0]) }}"
                                class="w-full h-[450px] object-cover transition-all duration-500 ease-in-out">
                        @else
                            <img src="{{ asset('storage/' . $room->image) }}" class="w-full h-[480px] object-cover">
                        @endif
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($gallery as $index => $img)
                            <img src="{{ asset('storage/' . $img) }}" onclick="changeImage(this.src)"
                                class="thumb-img rounded-2xl object-cover h-20 w-full cursor-pointer
                            {{ $index === 0 ? 'border-2 border-orange-500 opacity-100' : 'opacity-60' }}
                            transition-all hover:scale-105 shadow-md">
                        @endforeach
                    </div>
                </div>

                {{-- DETAIL --}}
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-orange-50" data-aos="fade-left">
                    <h2 class="text-3xl font-semibold text-gray-800 mb-4">
                        Detail & Fasilitas
                    </h2>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        {{ $room->description ?? 'Kamar dengan desain modern, privasi tinggi, dan layanan kelas atas.' }}
                    </p>

                    {{-- FASILITAS (hardcode dulu, bisa di-DB nanti) --}}
                    <div class="grid grid-cols-2 gap-y-6 gap-x-4 mb-10">
                        @foreach (['Super King Bed', 'Private Lounge', 'High Speed Wi-Fi', 'Jacuzzi & Bathtub', 'Breakfast in Room', '65” Smart TV', 'Premium Mini Bar', 'Safe Deposit Box'] as $facility)
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-orange-50">
                                    ✅
                                </div>
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ $facility }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- HARGA --}}
                    <div class="mb-8 p-6 bg-gray-900 rounded-3xl text-white shadow-2xl relative overflow-hidden">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-400 text-sm">Harga Per Malam</span>
                                <h3 class="text-3xl font-bold text-orange-500">
                                    Rp {{ number_format($room->price, 0, ',', '.') }}
                                </h3>
                            </div>
                            <span class="text-xs bg-orange-500 px-2 py-1 rounded font-bold">
                                BEST VALUE
                            </span>
                        </div>
                    </div>

                    {{-- BOOKING --}}
                    <a href="{{ route('booking', ['room_id' => $room->id]) }}"
                        class="group relative overflow-hidden block w-full text-center py-5 rounded-2xl bg-orange-500 text-white font-bold text-xl transition-all shadow-lg shadow-orange-200">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Booking Sekarang
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </span>
                        <div
                            class="absolute inset-0 bg-orange-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });

        function changeImage(src) {
            const hero = document.getElementById('mainHeroImage');
            const thumbs = document.querySelectorAll('.thumb-img');

            hero.style.opacity = '0.5';
            hero.style.filter = 'blur(4px)';

            setTimeout(() => {
                hero.src = src;
                hero.style.opacity = '1';
                hero.style.filter = 'blur(0)';
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
