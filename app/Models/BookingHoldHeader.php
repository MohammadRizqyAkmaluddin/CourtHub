<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHoldHeader extends Model
{
    protected $table = 'booking_hold_headers';

    protected $fillable = [
        'venue_id',
        'court_id',
        'user_id',
        'guest_contact',
        'booking_date',
        'expires_at',
    ];
    protected $cast = [
        'booking_date' => 'date',
        'expires_at'   => ''
    ];

    public function hold() {
        return $this->hasMany(BookingHold::class, 'booking_hold_header_id');
    }
    public function venue() {
        return $this->belongsTo(Venue::class);
    }
    public function court() {
        return $this->belongsTo(Court::class);
    }
}
