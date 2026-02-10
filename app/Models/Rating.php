<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'venue_id',
        'rate'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function venue() {
        return $this->belongsTo(Venue::class);
    }
}
