{{-- LOADER GLOBAL --}}
<div id="pageLoader"
    class="fixed inset-0 bg-white z-[9999] flex items-center justify-center opacity-100 pointer-events-auto transition-opacity duration-500">
    <div class="flex space-x-2">
        <div class="w-3 h-3 bg-orange-600 rounded-full animate-bounce"></div>
        <div class="w-3 h-3 bg-orange-500 rounded-full animate-bounce [animation-delay:0.15s]"></div>
        <div class="w-3 h-3 bg-orange-400 rounded-full animate-bounce [animation-delay:0.3s]"></div>
    </div>
</div>


<nav class="w-full fixed top-0 left-0 z-50 bg-black/40 backdrop-blur-xl border-b border-orange-500/40">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/" class="nav-link text-2xl font-bold text-orange-400">SUNSET HOTEL</a>

        <!-- MENU DESKTOP -->
        <div class="hidden md:flex space-x-10 font-semibold">
            <a href="/" class="nav-link text-white hover:text-orange-300 px-4 py-2">Home</a>
            <a href="/booking" class="nav-link text-white hover:text-orange-300 px-4 py-2">Booking</a>
            <a href="/about-us" class="nav-link text-white hover:text-orange-300 px-4 py-2">About us</a>
            <a href="{{ route('contact') }}" class="no-loader text-white hover:text-orange-300 px-4 py-2">Contact</a>
        </div>

        <!-- AUTH AREA -->
        @auth
            <div class="relative">
                <button id="profileBtn" class="flex items-center gap-2 no-loader">
                    <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="dropdownMenu" class="absolute right-0 mt-2 bg-white shadow-lg rounded-lg py-2 w-40 hidden">
                    <a href="/profile" class="nav-link block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Profil
                    </a>

                    <form method="POST" action="/logout" class="no-loader">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="/login" class="nav-link px-4 py-2 rounded-full bg-orange-500 hover:bg-orange-600 text-white">
                Login
            </a>
        @endauth

    </div>
</nav>


{{-- SCRIPT LOADER --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    const loader = document.getElementById("pageLoader");

    // Hilangkan loader setelah load
    setTimeout(() => {
        loader.classList.add("opacity-0", "pointer-events-none");
        setTimeout(() => loader.style.display = "none", 500);
    }, 500);

    // Saat klik link
    document.querySelectorAll("a.nav-link").forEach(link => {
        link.addEventListener("click", (e) => {
            const url = link.getAttribute("href");

            if (!url || url.startsWith("#")) return;

            e.preventDefault();

            loader.style.display = "flex";
            loader.classList.remove("opacity-0", "pointer-events-none");

            setTimeout(() => window.location.href = url, 250);
        });
    });

    // Saat submit form
    document.querySelectorAll("form:not(.no-loader)").forEach(form => {
        form.addEventListener("submit", () => {
            loader.style.display = "flex";
            loader.classList.remove("opacity-0", "pointer-events-none");
        });
    });

    // Saat reload / berpindah halaman (back/forward)
    window.addEventListener("beforeunload", () => {
        loader.style.display = "flex";
        loader.classList.remove("opacity-0", "pointer-events-none");
    });
});
</script>
