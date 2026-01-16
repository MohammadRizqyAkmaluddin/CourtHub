<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtBooking extends Model
{
    protected $fillable = ['court_id', 'user_id', 'booking_date', 'start_time', 'end_time', 'status', 'locked_until'];

    public function court() {
        return $this->belongsTo(Court::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function transaction() {
        return $this->hasOne(Transaction::class);
    }
}
