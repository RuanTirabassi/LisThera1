<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    protected $table = 'practitioners';
    protected $primaryKey = 'practitionerid';
    public $timestamps = false;

    protected $fillable = [
        'fullname',
        'dateofbirth',
        'cpf',
        'phone',
        'address',
        'isactive',
    ];

    // Relacionamentos
    public function guardians()
    {
        return $this->hasMany(PractitionerGuardian::class, 'practitionerid', 'practitionerid');
    }

    public function diagnoses()
    {
        return $this->hasMany(PractitionerDiagnosis::class, 'practitionerid', 'practitionerid');
    }

    public function clinicalHistory()
    {
        return $this->hasMany(PractitionerClinicalHistory::class, 'practitionerid', 'practitionerid');
    }

    public function sessionCheckins()
    {
        return $this->hasMany(SessionCheckin::class, 'practitionerid', 'practitionerid');
    }

    public function arenaSessions()
    {
        return $this->hasMany(ArenaSession::class, 'practitionerid', 'practitionerid');
    }
}
