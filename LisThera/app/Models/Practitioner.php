<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practitioner extends Model
{
    protected $table = 'practitioners';
    public $timestamps = false;

    protected $fillable = [
        'rfidtag',
        'name',
        'birthdate',
        'gender',
        'allergy',
        'isactive',
    ];

    protected $casts = [
        'birthdate'  => 'date',
        'isactive'   => 'boolean',
        'createdat'  => 'datetime',
        'updatedat'  => 'datetime',
    ];

    public function guardians(): HasMany
    {
        return $this->hasMany(PractitionerGuardian::class, 'practitionerid');
    }

    public function diagnoses(): HasMany
    {
        return $this->hasMany(PractitionerDiagnosis::class, 'practitionerid');
    }

    public function psychologyAssessments(): HasMany
    {
        return $this->hasMany(PsychologyAssessment::class, 'practitionerid');
    }
}
