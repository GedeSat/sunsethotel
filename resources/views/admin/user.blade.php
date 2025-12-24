@extends('layouts.admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container mx-auto px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manajemen User</h1>
            <p class="text-gray-500 mt-1">Kelola data pengguna dan hak akses sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-200 flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4 border-b">Nama Lengkap</th>
                        <th class="px-6 py-4 border-b">Email</th>
                        <th class="px-6 py-4 border-b text-center">Role</th>
                        <th class="px-6 py-4 border-b text-center">Bergabung</th>
                        <th class="px-6 py-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-orange-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Admin
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    User
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
  {{ optional($user->created_at)->format('d M Y') ?? '-' }}

</td>



                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                   class="text-blue-500 hover:text-blue-700" 
                                   title="Edit User">
                                    <i class="fa-solid fa-pen-to-square text-lg"></i>
                                </a>

                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus User">
                                        <i class="fa-solid fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                            <p>Belum ada data user yang tersedia.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection