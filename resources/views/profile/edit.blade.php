<x-app-layout>
    {{-- Custom Header dengan Latar Belakang Subtle --}}
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h2 class="font-serif font-bold text-3xl text-gray-800 leading-tight flex items-center gap-3">
                    <i class="fa-solid fa-circle-user text-orange-500"></i>
                    {{ __('Akun Saya') }}
                </h2>
                <p class="text-gray-500 text-sm mt-1 ml-10">
                    Kelola informasi pribadi dan keamanan akun Anda di Sunset Hotel.
                </p>
            </div>
            {{-- Hiasan kecil (opsional) --}}
            <div class="hidden md:block">
                <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-semibold tracking-wide border border-orange-200">
                    MEMBER AREA
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-orange-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Grid Layout: Kiri (Profile) - Kanan (Password & Danger Zone) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: Update Profile (Lebih Lebar) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow-xl shadow-orange-900/5 sm:rounded-2xl border-t-4 border-orange-400 relative overflow-hidden">
                        {{-- Dekorasi Latar Belakang --}}
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-orange-100 rounded-full opacity-50 blur-xl"></div>
                        
                        <div class="relative">
                            <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <i class="fa-solid fa-id-card text-orange-500"></i> Informasi Profil
                            </h3>
                            <p class="text-sm text-gray-500 mb-6 border-b border-gray-100 pb-4">
                                Perbarui nama akun dan alamat email profil Anda.
                            </p>
                            
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Keamanan & Hapus (Stacked) --}}
                <div class="space-y-8">
                    
                    {{-- 1. Update Password --}}
                    <div class="p-4 sm:p-8 bg-white shadow-xl shadow-orange-900/5 sm:rounded-2xl border-t-4 border-yellow-400 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 bg-yellow-100 rounded-full opacity-50 blur-xl"></div>
                        
                        <div class="relative">
                            <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <i class="fa-solid fa-key text-yellow-500"></i> Ganti Password
                            </h3>
                            <p class="text-sm text-gray-500 mb-6 border-b border-gray-100 pb-4">
                                Pastikan akun Anda aman dengan password yang kuat.
                            </p>

                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    {{-- 2. Delete User (Danger Zone) --}}
                    <div class="p-4 sm:p-8 bg-white shadow-xl shadow-red-900/5 sm:rounded-2xl border-t-4 border-rose-500 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 bg-rose-100 rounded-full opacity-50 blur-xl"></div>
                        
                        <div class="relative">
                            <h3 class="text-lg font-bold text-rose-600 mb-1 flex items-center gap-2">
                                <i class="fa-solid fa-triangle-exclamation"></i> Hapus Akun
                            </h3>
                            <p class="text-sm text-gray-500 mb-6 border-b border-gray-100 pb-4">
                                Tindakan ini permanen. Data tidak dapat dikembalikan.
                            </p>

                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>