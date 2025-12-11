<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunset Hotel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

  <!-- LOADER OVERLAY -->
<div id="pageLoader"
    class="fixed inset-0 bg-white z-[9999] flex items-center justify-center 
           opacity-100 pointer-events-auto 
           transition-opacity duration-700">

    <!-- Bola loading -->
    <div class="flex space-x-2">
        <div class="w-3 h-3 bg-orange-600 rounded-full animate-bounce"></div>
        <div class="w-3 h-3 bg-orange-500 rounded-full animate-bounce [animation-delay:0.15s]"></div>
        <div class="w-3 h-3 bg-orange-400 rounded-full animate-bounce [animation-delay:0.20s]"></div>
        <div class="w-3 h-3 bg-orange-400 rounded-full animate-bounce [animation-delay:0.25s]"></div>
    </div>

</div> <!-- WAJIB ADA!! -->


    @include('layouts.navigation')

    <main>
        {{ $slot }}
    </main>

    @include('layouts.footer')

<script>
window.addEventListener("load", () => {
    const loader = qs("#pageLoader");

    // Fade-out saat semua halaman selesai load
    setTimeout(() => {
        loader.classList.add("opacity-0");
        setTimeout(() => {
            loader.style.display = "none";
        }, 500);
    }, 900);

    // Loader saat klik link
    qsa("a.nav-link").forEach(link => {
        safeOn(link, "click", (e) => {
            const url = link.getAttribute("href");

            if (!url || url.startsWith("#")) return;

            e.preventDefault();

            loader.style.display = "flex";
            setTimeout(() => loader.classList.remove("opacity-0"), 10);

            setTimeout(() => {
                window.location.href = url;
            }, 350);
        });
    });

    // Loader saat submit form
    qsa("form:not(.no-loader)").forEach(form => {
        safeOn(form, "submit", () => {
            loader.style.display = "flex";
            loader.classList.remove("opacity-0");
        });
    });

});

</script>



</body>
</html>
