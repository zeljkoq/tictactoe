<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tournament
 * @package App
 */
class Tournament extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'winner'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'tournament_users');
    }
}
