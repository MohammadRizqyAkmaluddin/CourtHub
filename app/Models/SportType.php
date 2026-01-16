<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportType extends Model
{
    public function court() {
        return $this->belongsTo(Court::class);
    }
}
