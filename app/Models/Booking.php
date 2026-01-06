<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Pastikan fillable mencakup kolom waktu check-in/out manual
    protected $fillable = [
        'order_id',
        'user_id',
        'room_id',
        'check_in',       // Tanggal rencana (dari input user saat booking)
        'check_out',      // Tanggal rencana (dari input user saat booking)
        'total_price',
        'payment_status',
        'status',
        'payment_type',
        'paid_at',
        'snap_token',
        'name',
        'email',
        'phone',
        // --- TAMBAHAN PENTING ---
        'check_in_time',  // Waktu Admin klik tombol Check In (Real-time)
        'check_out_time', // Waktu Admin klik tombol Check Out (Real-time)
    ];

    // Casts agar format tanggal/jam bisa langsung diolah Carbon
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'paid_at' => 'datetime',
        // --- TAMBAHAN PENTING ---
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}