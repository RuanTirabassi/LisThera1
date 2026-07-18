<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCheckin extends Model
{
    protected $table = 'sessioncheckins';
    protected $primaryKey = 'sessioncheckinid';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid',
        'checkindate',
        'bloodpressure',
        'heartrate',
        'temperature',
        'oxygensaturation',
        'pain',
        'mood',
        'authorized',
        'authorizednotes',
        'recordedby',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid', 'practitionerid');
    }
}
