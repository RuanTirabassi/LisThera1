<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSessionEntity extends Model
{
    protected $table = 'sessionarenaentities';
    protected $primaryKey = 'sessionarenaentityid';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid',
        'therapistid',
        'role',
        'joinedat',
    ];

    public function session()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid', 'arenasessionid');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapistid', 'therapistid');
    }
}
