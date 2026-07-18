<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    protected $table = 'horses';
    protected $primaryKey = 'horseid';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'breed',
        'age',
        'isactive',
    ];

    public function clinicalNotes()
    {
        return $this->hasMany(HorseClinicalNote::class, 'horseid', 'horseid');
    }

    public function mounts()
    {
        return $this->hasMany(ArenaSessionMount::class, 'horseid', 'horseid');
    }
}
