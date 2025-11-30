<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
<<<<<<< HEAD
        'content',
        'fly_id',
        'user_id',
    ];
=======
        
        'content',
        'fly_id',
    ];

>>>>>>> origin/main
    public function fly()
    {
        return $this->belongsTo(Fly::class);
    }
}
