<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationHour extends Model
{
    protected $fillable = ['venue_id', 'day_of_week', 'open_time', 'close_time', 'is_closed'];

    public function venue(){
        return $this->belongsTo(Venue::class);
    }
}

