<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    protected $table = 'practitioners';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function diagnoses()
    {
        return $this->hasMany(PractitionerDiagnosis::class, 'practitioner_id');
    }

    public function guardians()
    {
        return $this->hasMany(PractitionerGuardian::class, 'practitioner_id');
    }

    public function clinicalHistory()
    {
        return $this->hasOne(PractitionerClinicalHistory::class, 'practitioner_id');
    }

    public function sessionCheckins()
    {
        return $this->hasMany(SessionCheckin::class, 'practitioner_id');
    }

    public function psychologyAssessments()
    {
        return $this->hasMany(PsychologyAssessment::class, 'practitioner_id');
    }

    public function physiotherapyAssessments()
    {
        return $this->hasMany(PhysiotherapyAssessment::class, 'practitioner_id');
    }

    public function pedagogyAssessments()
    {
        return $this->hasMany(PedagogyAssessment::class, 'practitioner_id');
    }

    public function getAgeAttribute()
    {
        return $this->birth_date
            ? \Carbon\Carbon::parse($this->birth_date)->age
            : null;
    }
}
