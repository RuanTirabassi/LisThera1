<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedagogyAssessmentCueLink extends Model
{
    protected $table = 'pedagogy_assessment_cue_links';
    public $timestamps = false;

    protected $fillable = [
        'pedagogy_assessment_id',
        'session_memory_cue_event_id',
    ];

    public function assessment()
    {
        return $this->belongsTo(PedagogyAssessment::class, 'pedagogy_assessment_id');
    }

    public function cueEvent()
    {
        return $this->belongsTo(SessionMemoryCueEvent::class, 'session_memory_cue_event_id');
    }
}
