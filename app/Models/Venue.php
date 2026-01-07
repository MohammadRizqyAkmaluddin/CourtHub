<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Venue extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'region_id', 'email', 'password', 'address', 'logo', 'cover'];

    protected $hidden = ['password'];

    public function region() {
        return $this->belongsTo(Region::class);
    }
}
