<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMemoryCueEvent extends Model
{
    protected $table = 'sessionmemorycueevents';
    protected $primaryKey = 'eventid';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid',
        'templateid',
        'recordedat',
        'notes',
    ];

    public function session()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid', 'arenasessionid');
    }

    public function template()
    {
        return $this->belongsTo(MemoryCueTemplate::class, 'templateid', 'templateid');
    }
}
