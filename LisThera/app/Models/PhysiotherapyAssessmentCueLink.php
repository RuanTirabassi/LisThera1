<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysiotherapyAssessmentCueLink extends Model
{
    protected $table = 'physiotherapy_assessment_cue_links';
    public $timestamps = false;

    protected $fillable = [
        'physiotherapy_assessment_id',
        'session_memory_cue_event_id',
    ];

    public function assessment()
    {
        return $this->belongsTo(PhysiotherapyAssessment::class, 'physiotherapy_assessment_id');
    }

    public function cueEvent()
    {
        return $this->belongsTo(SessionMemoryCueEvent::class, 'session_memory_cue_event_id');
    }
}
