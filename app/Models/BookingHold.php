<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHold extends Model
{
    protected $fillable = [
        'user_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'expires_at',
    ];

    protected $cast = [
        'booking_date' => 'date',
        'expires_at'   => ''
    ];

    public function court() {
        return $this->belongsTo(Court::class);
    }
}
