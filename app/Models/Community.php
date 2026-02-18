<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'communities';

    protected $fillable = [
        'user_id',
        'venue_id',
        'name',
        'sport_type_id',
        'city_id',
        'address',
        'latitude',
        'longitude',
        'membership_fee',
        'total_member',
        'max_slot',
        'description',
        'image',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return asset('storage/community/' . $this->image);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function venue() {
        return $this->belongsTo(Venue::class);
    }
    public function member() {
        return $this->hasMany(CommunityMember::class);
    }
    public function sportType() {
        return $this->belongsTo(SportType::class);
    }
    public function city() {
        return $this->belongsTo(City::class);
    }
}
