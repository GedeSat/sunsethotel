<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Hotel Sunset') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- FULL BACKGROUND SUNSET --}}
<body class=" ">

    {{-- NAVBAR HOTEL --}}
    @include('layouts.hotel-nav')

    {{-- CONTENT --}}
    <main class=""> {{-- Tambah padding biar tidak ketutup navbar --}}
        @yield('content')
    </main>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('dropdownMenu');

    profileBtn.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    // Klik di luar dropdown → tutup
    document.addEventListener('click', (e) => {
        if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>

</body>
</html>
