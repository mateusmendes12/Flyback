<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fly extends Model
{
    // Relação com votos
    public function votes()
    {
        return $this->hasMany(FlyVotes::class);
    }

    // Contagem de likes
    public function getLikesCountAttribute()
    {
        return $this->votes()->where('type_vote', 'like')->count();
    }

    // Contagem de unlikes
    public function getUnlikesCountAttribute()
    {
        return $this->votes()->where('type_vote', 'unlike')->count();
    }
}

