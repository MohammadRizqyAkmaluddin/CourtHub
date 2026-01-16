<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'city', 'profile_image'];

    protected $hidden = ['password'];

    public function courtBooking() {
        return $this->hasMany(CourtBooking::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
}

