<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'profile_image'];

    protected $hidden = ['password'];

    public function courtBooking() {
        return $this->hasMany(CourtBooking::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }

    protected $appends = ['profile_image_url'];

    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/profile/' . $this->profile_image);
        }

        return asset('storage/profile/empty.jpg');
    }
}

