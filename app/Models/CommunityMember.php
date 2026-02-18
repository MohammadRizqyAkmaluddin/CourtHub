<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityMember extends Model
{
    protected $table = 'community_members';
    protected $fillable = [
        'user_id',
        'community_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function community() {
        return $this->belongsTo(Community::class);
    }
}
