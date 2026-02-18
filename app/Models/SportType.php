<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    public function court() {
        return $this->hasMany(Court::class);
    }
    public function community() {
        return $this->hasMany(Community::class);
    }
}
