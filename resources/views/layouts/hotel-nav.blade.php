 <nav class="w-full fixed top-0 left-0 z-50 bg-black/40 backdrop-blur-xl border-b border-orange-500/40">
     <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
         <div class="text-2xl font-bold text-orange-400">SUNSET HOTEL</div>

         <div class="hidden md:flex space-x-10 font-semibold">
             <a href="/" class="text-white hover:text-orange-300 px-4 py-2">Home</a>
             <a href="/booking" class="text-white hover:text-orange-300 px-4 py-2">Booking</a>
             <a href="/about us" class="text-white hover:text-orange-300 px-4 py-2">About us</a>
             <a href="#contact" class="text-white hover:text-orange-300 px-4 py-2">Contact</a>
         </div>

         @auth
             <div class="relative">
                 <!-- PROFILE BUTTON -->
                 <button id="profileBtn" class="flex items-center gap-2">
                     <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                     <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                     </svg>
                 </button>

                 <!-- DROPDOWN -->
                 <div id="dropdownMenu" class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg py-2 w-40 hidden">

                     <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>

                     <form method="POST" action="/logout">
                         @csrf
                         <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                             Logout
                         </button>
                     </form>
                 </div>
             </div>
         @else
             <a href="/login" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white">
                 Login
             </a>
         @endauth



     </div>
 </nav>






 {{-- <nav class="w-full fixed top-0 left-0 z-50 bg-black/40 backdrop-blur-xl border-b border-orange-500/40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-white tracking-wide">Sunset Hotel</a>

        <div class="flex gap-6 items-center justify-between">
            <a href="/" class="text-white hover:text-orange-300 px-4 py-2">Home</a>
            <a href="/booking" class="text-white hover:text-orange-300 px-4 py-2">Booking</a>
             <a href="/booking" class="text-white hover:text-orange-300 px-4 py-2">About us</a>

            @auth
                <a href="/dashboard" class="text-white hover:text-orange-300">Dashboard</a>
            @else
                <a href="/login" class="px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white">
                    Login
                </a>
            @endauth
        </div>

    </div>
</nav> --}}
