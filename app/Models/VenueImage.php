<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenueImage extends Model
{
    protected $fillable = ['venue_id', 'image'];

    protected $appends = ['image_url'];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/venue/' . $this->image);
    }
}
