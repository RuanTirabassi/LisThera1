<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedagogyAssessment extends Model
{
    protected $table = 'pedagogy_assessments';
    public $timestamps = false;

    protected $fillable = [
        'practitioner_id',
        'arena_session_id',
        'therapist_id',
        'assessment_date',
        'overallscore',
        'evolutionnotes',
        'sessionnotes',
    ];

    protected $casts = [
        'assessment_date' => 'datetime',
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
        return $this->hasMany(PedagogyAssessmentCueLink::class, 'pedagogy_assessment_id');
    }
}
