<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['court_booking_id', 'method', 'amount'];

    public function courtBooking() {
        return $this->belongsTo(CourtBooking::class);
    }
}
