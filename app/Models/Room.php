<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id_room';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_room');
    }
}
