<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomsController extends Controller
{
    // Tampilkan semua kamar
    public function index()
    {
        $rooms = Room::all();

        return view('admin.rooms', [
            'title' => 'Kelola Kamar',
            'rooms' => $rooms
        ]);
    }

    // Tampilkan form tambah kamar
    public function create()
    {
        return view('admin.CreateRooms', [
            'title' => 'Tambah Kamar'
        ]);
    }

    // Simpan kamar baru
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'type'  => 'required',
            'price' => 'required|numeric'
        ]);

        Room::create([
            'name'  => $request->name,
            'type'  => $request->type,
            'price' => $request->price,
        ]);

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil ditambahkan!');
    }

    // Tampilkan form edit kamar
    public function edit($id)
    {
        $room = Room::findOrFail($id);

        return view('admin.edit', [
            'title' => 'Edit Kamar',
            'room'  => $room
        ]);
    }

    // Update data kamar
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'type'  => 'required',
            'price' => 'required|numeric'
        ]);

        $room = Room::findOrFail($id);

        $room->update([
            'name'  => $request->name,
            'type'  => $request->type,
            'price' => $request->price,
        ]);

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil diperbarui!');
    }

    // Hapus kamar
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil dihapus!');
    }


    
}


