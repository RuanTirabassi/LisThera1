<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisReference extends Model
{
    protected $table = 'diagnosis_reference';
    public $timestamps = false;

    protected $fillable = ['name', 'code', 'description'];

    public function practitionerDiagnoses()
    {
        return $this->hasMany(PractitionerDiagnosis::class, 'diagnosisreferenceid');
    }
}
