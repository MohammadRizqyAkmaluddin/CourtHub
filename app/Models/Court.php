<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $fillable = ['venue_id', 'sport_type_id', 'court_type_id', 'court_material_id', 'name', 'price', 'image'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return asset('storage/court/' . $this->image);
    }

    public function venue() {
        return $this->belongsTo(Venue::class);
    }
    public function sportType() {
        return $this->belongsTo(SportType::class);
    }
    public function courtType() {
        return $this->belongsTo(CourtType::class);
    }
    public function courtBooking() {
        return $this->hasMany(CourtBooking::class);
    }
}
