<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-xl p-6">
            <h2 class="text-2xl font-bold text-orange-600 mb-8">Admin Panel</h2>

            <nav class="space-y-4">
                <a href="/admin" class="block p-3 rounded-lg hover:bg-orange-100 text-gray-700">Dashboard</a>
                <a href="/admin/rooms" class="block p-3 rounded-lg hover:bg-orange-100 text-gray-700">Kelola Kamar</a>
                <a href="/admin/bookings" class="block p-3 rounded-lg hover:bg-orange-100 text-gray-700">Booking</a>
                <a href="/admin/users" class="block p-3 rounded-lg hover:bg-orange-100 text-gray-700">User</a>
                <a href="{{ route('admin.laporan') }}"
                    class="{{ request()->routeIs('admin.laporan') ? 'bg-orange-100 text-orange-700' : 'text-gray-700 hover:bg-orange-100' }} block p-3 rounded-lg transition-colors">
                    <div >
                        Laporan
                    </div>
                </a>
            </nav>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8">
            <h1 class="text-3xl font-semibold mb-6">{{ $title ?? '' }}</h1>

            <!-- SECTION KONTEN -->
            @yield('content')

        </main>

    </div>

</body>

</html>
