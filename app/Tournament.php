<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'winner'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'tournament_users');
    }
}
