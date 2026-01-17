<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Venue extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'venues';

    protected $fillable = ['name', 'city_id', 'email', 'password', 'phone', 'description', 'rules', 'address', 'bank_account_number'];

    protected $hidden = ['password'];

    public function city() {
        return $this->belongsTo(City::class);
    }
    public function operationHour() {
        return $this->hasOne(OperationHour::class);
    }
    public function reservationTerm() {
        return $this->hasOne(ReservationTerm::class);
    }
    public function facility() {
        return $this->hasMany(Facility::class);
    }
    public function court() {
        return $this->hasMany(Court::class);
    }
    public function courtBooking() {
        return $this->hasMany(CourtBooking::class);
    }
}
