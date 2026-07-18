<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerDiagnosis extends Model
{
    protected $table = 'practitionerdiagnosis';
    protected $primaryKey = 'diagnosisid';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid',
        'diagnosisreferenceid',
        'diagnosedby',
        'diagnosisdate',
        'notes',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid', 'practitionerid');
    }

    public function diagnosisReference()
    {
        return $this->belongsTo(DiagnosisReference::class, 'diagnosisreferenceid', 'diagnosisreferenceid');
    }
}
