
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">
<footer class="bg-[#0b0b0b] text-gray-300 pt-12 pb-6 mt-auto text-sm">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-5 gap-10">

        <!-- Logo & Description -->
        <div class="col-span-2 md:col-span-1">
            <div class="flex items-center gap-3 mb-4">
                 <a href="/" class="nav-link text-2xl font-bold text-orange-400">SUNSET HOTEL</a>
            </div>
            <p class="text-gray-400 leading-relaxed text-xs">
                Experience luxury, comfort, and unforgettable moments at Sunset Hotel & Resort.
            </p>
        </div>

        <!-- Column 1 -->
        <div>
            <h3 class="text-white font-semibold mb-3 text-sm">Hotel</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-white transition">Fasilitas</a></li>
                <li><a href="#" class="hover:text-white transition">Galeri</a></li>
            </ul>
        </div>

        <!-- Column 2 -->
        <div>
            <h3 class="text-white font-semibold mb-3 text-sm">Kamar</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white transition">Deluxe Room</a></li>
                <li><a href="#" class="hover:text-white transition">Suite Room</a></li>
                <li><a href="#" class="hover:text-white transition">Family Room</a></li>
            </ul>
        </div>

        <!-- Column 3 -->
        <div>
            <h3 class="text-white font-semibold mb-3 text-sm">Layanan</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white transition">Spa</a></li>
                <li><a href="#" class="hover:text-white transition">Restoran</a></li>
                <li><a href="#" class="hover:text-white transition">Transport</a></li>
            </ul>
        </div>

        <!-- Column 4 (Map Section) -->
        <div>
            <h3 class="text-white font-semibold mb-3 text-sm">Lokasi</h3>
            <div class="rounded-lg overflow-hidden shadow-md border border-gray-700">
                <a href="https://maps.app.goo.gl/ryH9A4xVCgBtdwnK7" target="_blank" rel="noopener noreferrer" class="block hover:opacity-90 transition-opacity">
                <iframe class="relative z-0 pointer-events-none" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.4106203122596!2d115.16860127472612!3d-8.67252578845813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd240ebd164b1cb%3A0xc8af24076fa0ec4e!2sKuta%20Beach!5e0!3m2!1sen!2sid!4v1700000000000"
                    width="100%" 
                    height="140" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>

    <!-- Divider -->
    <div class="border-t border-gray-700 mt-10 pt-6 max-w-7xl mx-auto"></div>

    <!-- Social Icons -->
  <div class="flex justify-center space-x-4 mb-4 relative z-50">


        <a href="#" class="p-2 rounded-full border border-gray-600 hover:bg-gray-200 hover:text-black transition">
            <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="#" class="p-2 rounded-full border border-gray-600 hover:bg-gray-200 hover:text-black transition">
            <i class="fa-brands fa-twitter"></i>
        </a>
        <a href="#" class="p-2 rounded-full border border-gray-600 hover:bg-gray-200 hover:text-black transition">
            <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="#" class="p-2 rounded-full border border-gray-600 hover:bg-gray-200 hover:text-black transition">
            <i class="fa-brands fa-whatsapp text-lg"></i>

        </a>
    </div>

    <!-- Copyright -->
    <p class="text-center text-gray-500 text-xs">
        &copy; <?= date('Y'); ?>  Sunset Hotel & Resort. All rights reserved.
    </p>
</footer>
