<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologyAssessment extends Model
{
    protected $table = 'psychology_assessments';
    public $timestamps = false;

    protected $fillable = [
        'arena_session_id',
        'practitioner_id',
        'therapist_id',
        'assessed_at',
        // Domínios clínicos
        'emotional_regulation',
        'social_interaction',
        'communication',
        'attention_focus',
        'behavioral_response',
        'anxiety_level',
        'motivation',
        'self_esteem',
        // Escores
        'overall_score',
        'evolution_notes',
        'session_notes',
    ];

    protected $casts = [
        'assessed_at' => 'datetime',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id');
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapist_id');
    }

    public function arenaSession()
    {
        return $this->belongsTo(ArenaSession::class, 'arena_session_id');
    }

    public function cueLinks()
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'psychology_assessment_id');
    }
}
