<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsychologyAssessmentCueLink extends Model
{
    protected $table = 'psychology_assessment_cue_links';

    protected $fillable = [
        'psychology_assessment_id',
        'memory_cue_template_id',
        'cue_label',
        'cue_description',
        'cue_type',
        'intensity',
        'therapist_notes',
    ];

    public function psychologyAssessment(): BelongsTo
    {
        return $this->belongsTo(PsychologyAssessment::class, 'psychology_assessment_id');
    }

    public function memoryCueTemplate(): BelongsTo
    {
        return $this->belongsTo(MemoryCueTemplate::class, 'memory_cue_template_id');
    }
}
