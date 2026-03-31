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

    protected $fillable = ['name', 'city_id', 'email', 'password', 'description', 'rules', 'image', 'address', 'bank_account'];

    protected $hidden = ['password'];

    public function city() {
        return $this->belongsTo(City::class);
    }
    public function operationHours() {
        return $this->hasMany(OperationHour::class);
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
    public function images() {
        return $this->hasMany(VenueImage::class);
    }
    public function firstImage()
    {
        return $this->hasOne(VenueImage::class)->oldestOfMany();
    }
    public function community() {
        return $this->hasMany(Community::class);
    }
    public function booking() {
        return $this->hasMany(Booking::class);
    }
    public function ratings()
{
    return $this->hasManyThrough(
        Rating::class,
        Booking::class,
        'venue_id',     // foreign key di bookings
        'booking_id',   // foreign key di ratings
        'id',           // local key di venues
        'id'            // local key di bookings
    );
}
}
