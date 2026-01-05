<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_price',
        'payment_status',
        'status',
        'payment_type',
        'paid_at',
        'snap_token',
        'name',
        'email',
        'phone',
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
