<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number',
        'room_type',
        'rate_per_night',
        'description',
        'profile_picture',
        'gallery',
        'is_available',
        'features'
    ];

    protected $casts = [
        'rate_per_night' => 'float',
    ];
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
