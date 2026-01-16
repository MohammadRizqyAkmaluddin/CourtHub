<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = ['transaction_id', 'venue_share', 'platform_share', 'status'];

    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
