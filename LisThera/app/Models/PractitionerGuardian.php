<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerGuardian extends Model
{
    protected $table = 'practitionerguardians';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid', 'fullname', 'relationship',
        'phonenumber', 'email',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }
}
