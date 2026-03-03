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
        'guest_name',
        'booking_date',
        'total_price',
        'start_time',
        'end_time',
        'price',
        'midtrans_order_id',
        'payment_status',
        'status'
    ];

    public function sessions() {
        return $this->hasMany(BookingSession::class);
    }
}
