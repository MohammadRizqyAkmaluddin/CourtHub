<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['city', 'province'];

    public function venues() {
        return $this->hasMany(Venue::class);
    }
}
