<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    protected $table = 'horses';
    public $timestamps = false;

    protected $fillable = [
        'name', 'breed', 'birthdate',
        'rfidtoken', 'notes',
    ];

    public function clinicalNotes()
    {
        return $this->hasMany(HorseClinicalNote::class, 'horseid');
    }

    public function mounts()
    {
        return $this->hasMany(ArenaSessionMount::class, 'horseid');
    }
}
