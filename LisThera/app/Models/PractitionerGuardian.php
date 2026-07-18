<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerGuardian extends Model
{
    protected $table = 'practitionerguardians';
    protected $primaryKey = 'guardianid';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid',
        'fullname',
        'relationship',
        'phone',
        'email',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid', 'practitionerid');
    }
}
