<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunset Hotel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom glow border */
        .glow-border {
            border: 1px solid rgba(255,125,50,0.5);
            box-shadow: 0 0 20px rgba(255,125,50,0.2);
        }
        .glow-button {
            border: 1px solid rgba(255,125,50,0.8);
            color: #ff7d32;
        }
        .glow-button:hover {
            background-color: rgba(255,125,50,0.2);
        }
    </style>
</head>

<body class="bg-black text-white">

    {{-- NAVBAR SUNSET --}}
    <nav class="w-full fixed top-0 left-0 z-50 bg-black/40 backdrop-blur-xl border-b border-orange-500/40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-orange-400">SUNSET HOTEL</div>

            <div class="hidden md:flex space-x-10 font-semibold">
                <a href="/" class="hover:text-orange-400">Home</a>
                <a href="#rooms" class="hover:text-orange-400">Rooms</a>
                <a href="#facilities" class="hover:text-orange-400">Facilities</a>
                <a href="#contact" class="hover:text-orange-400">Contact</a>
            </div>

            <a href="{{ route('login') }}"
                class="px-5 py-2 rounded-xl glow-button font-semibold backdrop-blur-md">
                LOGIN
            </a>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="pt-24">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-black border-t border-orange-500/30 py-6 text-center text-gray-300 mt-12">
        © {{ date('Y') }} Sunset Hotel. All Rights Reserved.
    </footer>

</body>
</html>
