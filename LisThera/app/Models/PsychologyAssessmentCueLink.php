<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PsychologyAssessmentCueLink extends Model
{
    protected $table = 'psychologyassessmentcuelinks';

    // A tabela no BD usa createdat sem updated_at
    public $timestamps = false;

    protected $fillable = [
        'psychologyassessmentid',
        'sessionmemorycueeventid',
        'professionaljustification',
        'intensityscore',
    ];

    protected $casts = [
        'createdat' => 'datetime',
    ];

    public function psychologyAssessment(): BelongsTo
    {
        return $this->belongsTo(PsychologyAssessment::class, 'psychologyassessmentid');
    }

    public function sessionMemoryCueEvent(): BelongsTo
    {
        return $this->belongsTo(SessionMemoryCueEvent::class, 'sessionmemorycueeventid');
    }
}
