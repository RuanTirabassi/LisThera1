<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    protected $table = 'arenas';
    protected $primaryKey = 'arenaid';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'isactive',
    ];

    public function iotDevices()
    {
        return $this->hasMany(IotDevice::class, 'arenaid', 'arenaid');
    }

    public function arenaSessions()
    {
        return $this->hasMany(ArenaSession::class, 'arenaid', 'arenaid');
    }
}
