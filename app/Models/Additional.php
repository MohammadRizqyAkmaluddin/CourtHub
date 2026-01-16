<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    protected $fillable = ['court_id', 'additional_type_id', 'description', 'price'];
    
    public function additionalType() {
        return $this->belongsTo(AdditionalType::class);
    }
}
