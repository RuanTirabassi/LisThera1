<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Therapist extends Model
{
    protected $table = 'therapists';
    public $timestamps = false;

    protected $fillable = [
        'rfidtag',
        'name',
        'specialty',
        'professionalreg',
        'isactive',
    ];

    protected $casts = [
        'isactive'  => 'boolean',
        'createdat' => 'datetime',
        'updatedat' => 'datetime',
    ];

    public function memoryCueTemplates(): HasMany
    {
        return $this->hasMany(MemoryCueTemplate::class, 'therapistid');
    }

    public function psychologyAssessments(): HasMany
    {
        return $this->hasMany(PsychologyAssessment::class, 'therapistid');
    }
}
