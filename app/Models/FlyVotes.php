<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fly;

class FlyVotes extends Model
{
    
    protected $fillable = [
        'fly_id',
        'user_id',
        'type_vote',
    ];
    public function fly()
{
    return $this->belongsTo(Fly::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}