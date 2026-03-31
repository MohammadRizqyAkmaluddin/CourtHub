<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLevel extends Model
{
    protected $table = 'activity_levels';
    protected $fillable = ['user_id', 'level', 'total_activity', 'total_spending'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
