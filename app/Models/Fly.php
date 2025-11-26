<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fly extends Model
{ 
        protected $fillable = [

        'title',
        'description',
        'status',
        'user_id',
        'departament_id',
        ];
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
    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contributions(){
        return $this->hasMany(Contribution::class);
    }
}

