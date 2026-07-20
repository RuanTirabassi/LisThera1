<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSession extends Model
{
    protected $table = 'arena_sessions';
    public $timestamps = false;

    protected $fillable = [
        'session_checkin_id',
        'arena_id',
        'started_by',
        'started_at',
        'ended_at',
        'status',
        'notes',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
    ];

    // Praticante chega via sessionCheckin
    public function sessionCheckin()
    {
        return $this->belongsTo(SessionCheckin::class, 'session_checkin_id');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arena_id');
    }

    // Terapeuta que iniciou a sessão
    public function startedByTherapist()
    {
        return $this->belongsTo(Therapist::class, 'started_by');
    }

    public function arenaEntities()
    {
        return $this->hasMany(ArenaSessionEntity::class, 'arena_session_id');
    }

    public function mounts()
    {
        return $this->hasMany(ArenaSessionMount::class, 'arena_session_id');
    }

    public function memoryCueEvents()
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'arena_session_id');
    }

    public function getIsActiveAttribute()
    {
        return $this->status === 'in_progress';
    }

    public function getDurationAttribute()
    {
        if (!$this->started_at) return null;
        $end = $this->ended_at ?? now();
        return $this->started_at->diffInMinutes($end);
    }
}
