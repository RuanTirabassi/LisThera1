<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologyAssessmentCueLink extends Model
{
    protected $table = 'psychology_assessment_cue_links';
    public $timestamps = false;

    protected $fillable = [
        'psychology_assessment_id',
        'session_memory_cue_event_id',
    ];

    public function assessment()
    {
        return $this->belongsTo(PsychologyAssessment::class, 'psychology_assessment_id');
    }

    public function cueEvent()
    {
        return $this->belongsTo(SessionMemoryCueEvent::class, 'session_memory_cue_event_id');
    }
}
