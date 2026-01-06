<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
   protected $fillable = [
    'name',
    'slug',
    'type',
    'price',
    'description',
    'image',
    'is_active',
    'gallery',
    'status',
];


protected $casts = [
    'gallery' => 'array',
];


}
