<x-homepage-layout>

    {{-- HERO SECTION --}}
    <section class="relative h-[90vh] w-full">
        <img src="/images/hotel-hero.jpg"
             class="absolute inset-0 w-full h-full object-cover brightness-75">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center px-6">
            <h1 class="text-5xl md:text-6xl font-bold drop-shadow">
                Sunset Hotel
            </h1>
            <p class="mt-4 text-lg md:text-2xl drop-shadow">
                Experience Bali’s Most Beautiful Oceanfront Sunset Resort
            </p>
        </div>
    </section>

    {{-- BOOKING CARD --}}
    <section class="max-w-5xl mx-auto -mt-16 px-6">
        <div class="bg-white shadow-lg rounded-2xl p-6 grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label class="text-sm font-semibold">Check-in</label>
                <input type="date" class="mt-1 w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold">Check-out</label>
                <input type="date" class="mt-1 w-full border rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold">Guests</label>
                <select class="mt-1 w-full border rounded-lg p-2">
                    <option>1 Guest</option>
                    <option>2 Guests</option>
                    <option>3 Guests</option>
                </select>
            </div>

            <div class="flex items-end">
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Book Now
                </button>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="max-w-7xl mx-auto mt-20 px-6" id="rooms">
        <h2 class="text-3xl font-bold text-center mb-10">Our Rooms</h2>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="rounded-xl overflow-hidden shadow">
                <img src="/images/room1.jpg" class="w-full h-60 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl">Deluxe Room</h3>
                </div>
            </div>

            <div class="rounded-xl overflow-hidden shadow">
                <img src="/images/room2.jpg" class="w-full h-60 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl">Ocean View Suite</h3>
                </div>
            </div>

            <div class="rounded-xl overflow-hidden shadow">
                <img src="/images/room3.jpg" class="w-full h-60 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl">Family Room</h3>
                </div>
            </div>
        </div>
    </section>

</x-homepage-layout>
