<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fly;

class Departament extends Model
{
 
    protected $fillable = [
        'name',
        'description',
        'email_institucional',
        'telefone',
    ];
    public function flies()
    {
        return $this->hasMany(Fly::class);
    }
}