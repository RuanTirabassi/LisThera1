<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCheckin extends Model
{
    protected $table = 'sessioncheckins';
    public $timestamps = false;

    protected $fillable = [
        'practitionerid', 'checkedat',
        'bloodpressuresys', 'bloodpressuredia',
        'heartrate', 'temperature', 'oxygensaturation',
        'painlevel', 'mobilityrating', 'moodrating',
        'sessionauthorized', 'authorizationnotes',
    ];

    protected $casts = [
        'checkedat'          => 'datetime',
        'sessionauthorized'  => 'boolean',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitionerid');
    }
}
