<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Practitioner extends Model
{
    protected $table = 'practitioners';
    public $timestamps = false;

    protected $fillable = [
        'fullname', 'birthdate', 'rfidtoken',
        'phonenumber', 'address', 'notes',
    ];

    public function diagnoses()
    {
        return $this->hasMany(PractitionerDiagnosis::class, 'practitionerid');
    }

    public function guardians()
    {
        return $this->hasMany(PractitionerGuardian::class, 'practitionerid');
    }

    public function sessionCheckins()
    {
        return $this->hasMany(SessionCheckin::class, 'practitionerid');
    }

    public function arenaSessions()
    {
        return $this->hasMany(ArenaSession::class, 'practitionerid');
    }

    public function getAgeAttribute()
    {
        return $this->birthdate ? \Carbon\Carbon::parse($this->birthdate)->age : null;
    }
}
