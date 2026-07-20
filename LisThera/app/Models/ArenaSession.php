<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArenaSession extends Model
{
    protected $table = 'arenasessions';
    public $timestamps = false;

    protected $fillable = [
        'sessioncheckinid',
        'arenaid',
        'status',
        'startedat',
        'endedat',
        'startedby',
        'endedby',
    ];

    protected $casts = [
        'startedat'  => 'datetime',
        'endedat'    => 'datetime',
        'createdat'  => 'datetime',
    ];

    public function arena(): BelongsTo
    {
        return $this->belongsTo(Arena::class, 'arenaid');
    }

    public function sessionCheckin(): BelongsTo
    {
        return $this->belongsTo(SessionCheckin::class, 'sessioncheckinid');
    }

    public function memoryCueEvents(): HasMany
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'arenasessionid');
    }

    public function psychologyAssessments(): HasMany
    {
        return $this->hasMany(PsychologyAssessment::class, 'arenasessionid');
    }

    public function mounts(): HasMany
    {
        return $this->hasMany(ArenaSessionMount::class, 'arenasessionid');
    }
}
