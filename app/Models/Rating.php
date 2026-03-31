<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = [
        'booking_id',
        'rate',
        'review',
    ];

    public function booking() {
        return $this->hasMany(Booking::class);
    }
}
