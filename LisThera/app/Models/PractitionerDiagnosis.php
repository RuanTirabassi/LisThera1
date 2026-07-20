<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerDiagnosis extends Model
{
    protected $table = 'practitionerdiagnosis';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid', 'diagnosisreferenceid',
        'diagnoseddate', 'notes',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }

    public function diagnosisReference()
    {
        return $this->belongsTo(DiagnosisReference::class, 'diagnosisreferenceid');
    }
}
