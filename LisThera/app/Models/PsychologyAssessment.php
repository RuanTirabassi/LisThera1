<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PsychologyAssessment extends Model
{
    protected $table = 'psychologyassessments';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'practitionerid',
        'arenasessionid',
        'therapistid',
        'assessmentdate',
        'vabscommunication',
        'vabssocialization',
        'vabsdailyliving',
        'vabsmotorskills',
        'interactionwithhorse',
        'touchacceptance',
        'impulsecontrol',
        'instructionfollowing',
        'currentmedication',
        'maincomplaints',
        'createdat',
        'updatedat',
        'deletedat',
    ];

    protected $casts = [
        'assessmentdate' => 'date',
        'createdat'      => 'datetime',
        'updatedat'      => 'datetime',
        'deletedat'      => 'datetime',
    ];

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function arenaSession(): BelongsTo
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function cueLinks(): HasMany
    {
        return $this->hasMany(PsychologyAssessmentCueLink::class, 'psychologyassessmentid');
    }
}
