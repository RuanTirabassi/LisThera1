<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    protected $table = 'arenas';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'capacity'];

    public function sessions()
    {
        return $this->hasMany(ArenaSession::class, 'arenaid');
    }
}
