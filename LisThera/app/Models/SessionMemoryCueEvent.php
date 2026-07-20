<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SessionMemoryCueEvent extends Model
{
    protected $table = 'sessionmemorycueevents';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid',
        'arenaentityid',
        'therapistid',
        'memorycuetemplateid',
        'recordedat',
        'arenasessionmountid',
    ];

    protected $casts = [
        'recordedat' => 'datetime',
    ];

    public function memoryCueTemplate(): BelongsTo
    {
        return $this->belongsTo(MemoryCueTemplate::class, 'memorycuetemplateid');
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function arenaSession(): BelongsTo
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function arenaSessionMount(): BelongsTo
    {
        return $this->belongsTo(ArenaSessionMount::class, 'arenasessionmountid');
    }

    public function psychologyAssessmentCueLinks(): HasMany
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'sessionmemorycueeventid');
    }
}
