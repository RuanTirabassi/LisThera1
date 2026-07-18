<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IotDevice extends Model
{
    protected $table = 'iotdevices';
    protected $primaryKey = 'deviceid';
    public $timestamps = false;

    protected $fillable = [
        'arenaid',
        'devicetype',
        'serialnumber',
        'isactive',
    ];

    public function arena()
    {
        return $this->belongsTo(Arena::class, 'arenaid', 'arenaid');
    }
}
