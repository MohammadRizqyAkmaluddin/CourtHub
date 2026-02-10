<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'venue_id',
        'court_id',
        'user_id',
        'guest_contact',
        'booking_date',
        'total_price',
        'status'
    ];

    public function sessions() {
        return $this->hasMany(BookingSession::class);
    }
}
