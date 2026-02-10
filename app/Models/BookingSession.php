<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSession extends Model
{
    protected $fillable = [
        'booking_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
    ];

    protected $cast = [
        'booking_date' => 'date'
    ];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}
