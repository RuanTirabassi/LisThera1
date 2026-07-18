<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSession extends Model
{
    protected $table = 'arenasessions';
    protected $primaryKey = 'arenasessionid';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid',
        'arenaid',
        'sessioncheckinid',
        'startedat',
        'endedat',
        'status',
        'notes',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid', 'practitionerid');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arenaid', 'arenaid');
    }

    public function sessionCheckin()
    {
        return $this->belongsTo(SessionCheckin::class, 'sessioncheckinid', 'sessioncheckinid');
    }

    public function entities()
    {
        return $this->hasMany(ArenaSessionEntity::class, 'arenasessionid', 'arenasessionid');
    }

    public function mounts()
    {
        return $this->hasMany(ArenaSessionMount::class, 'arenasessionid', 'arenasessionid');
    }

    public function memoryCueEvents()
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'arenasessionid', 'arenasessionid');
    }
}
