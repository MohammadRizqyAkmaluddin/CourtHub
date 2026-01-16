<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalType extends Model
{
    public function additional() {
        return $this->hasMany(Additional::class);
    }
}
