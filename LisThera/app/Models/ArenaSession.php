<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSession extends Model
{
    protected $table = 'arenasessions';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid', 'therapistid', 'arenaid',
        'startedat', 'endedat', 'notes',
    ];

    protected $casts = [
        'startedat' => 'datetime',
        'endedat'   => 'datetime',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arenaid');
    }

    public function mounts()
    {
        return $this->hasMany(ArenaSessionMount::class, 'arenasessionid');
    }

    public function memoryCueEvents()
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'arenasessionid');
    }

    public function getIsActiveAttribute()
    {
        return is_null($this->endedat);
    }

    public function getDurationAttribute()
    {
        if (!$this->startedat) return null;
        $end = $this->endedat ?? now();
        return $this->startedat->diffInMinutes($end);
    }
}
