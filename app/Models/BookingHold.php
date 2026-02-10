<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHold extends Model
{
    protected $fillable = [
        'booking_hold_header_id',
        'start_time',
        'end_time',
        'price'
    ];

    public function header() {
        return $this->belongsTo(BookingHoldHeader::class, 'booking_hold_header_id');
    }
}
