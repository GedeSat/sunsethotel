<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Panggil Model

class ContactController extends Controller
{
    // ==========================================
    // BAGIAN 1: UNTUK TAMU (PUBLIC)
    // ==========================================

    // 1. Menampilkan Halaman Form Contact (Untuk Tamu)
    public function index()
    {
        // Ini harusnya return view 'contact' (form), BUKAN 'admin.laporan'
        return view('contact', ['title' => 'Sunset Hotel – Contact Us']);
    }

    // 2. Proses Simpan Pesan (Saat Tamu klik Kirim)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }

    public function laporan()
    {
        // Ambil semua data pesan, urutkan dari yang terbaru
        $contacts = Contact::latest()->get(); 

        // Kirim data $contacts ke view admin
        return view('admin.laporan', compact('contacts'));
    }
}