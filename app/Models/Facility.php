<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    protected $fillable = ['venue_id', 'facility_type_id'];

    public function venue() {
        return $this->belongsTo(Venue::class);
    }
    public function facilityType(){
        return $this->belongsTo(FacilityType::class);
    }
}
