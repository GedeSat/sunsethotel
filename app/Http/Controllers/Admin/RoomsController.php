<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Room;

class RoomsController extends Controller
{
    // =========================
    // LIST KAMAR
    // =========================
    public function index()
    {
        $rooms = Room::all();

        return view('admin.rooms', [
            'title' => 'Kelola Kamar',
            'rooms' => $rooms
        ]);
    }

    // =========================
    // FORM TAMBAH KAMAR
    // =========================
    public function create()
    {
        return view('admin.CreateRooms', [
            'title' => 'Tambah Kamar'
        ]);
    }

    // =========================
    // SIMPAN KAMAR BARU
    // =========================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'type'        => 'required|string',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:webp,jpg,jpeg,png|max:2048',
        ]);

        // SLUG AUTO
        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = true;

        // SIMPAN GAMBAR (SATU KALI SAJA)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil ditambahkan!');
    }

    // =========================
    // FORM EDIT KAMAR
    // =========================
    public function edit($id)
    {
        $room = Room::findOrFail($id);

        return view('admin.edit', [
            'title' => 'Edit Kamar',
            'room'  => $room
        ]);
    }

    // =========================
    // UPDATE KAMAR
    // =========================
 public function update(Request $request, $id)
{
    $room = Room::findOrFail($id);

    $data = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // checkbox
    $data['is_active'] = $request->has('is_active');

    // image utama
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('rooms', 'public');
    }

    // gallery
    if ($request->hasFile('gallery')) {
        $galleryPaths = [];

        foreach ($request->file('gallery') as $img) {
            $galleryPaths[] = $img->store('rooms/gallery', 'public');
        }

        $data['gallery'] = $galleryPaths;
    }

    $room->update($data);

    return back()->with('success', 'Kamar berhasil diperbarui');
}




    // =========================
    // HAPUS KAMAR
    // =========================
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect('/admin/rooms')->with('success', 'Kamar berhasil dihapus!');
    }
}
