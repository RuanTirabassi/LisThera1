<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerClinicalHistory extends Model
{
    protected $table = 'practitioner_clinical_history';
    public $timestamps = false;

    protected $fillable = [
        'practitioner_id',
        'recorded_by',
        'notes',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id');
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
