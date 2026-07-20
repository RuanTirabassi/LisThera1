<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMemoryCueEvent extends Model
{
    protected $table = 'sessionmemorycueevents';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid', 'memorycuetemplateid',
        'recordedat', 'notes',
    ];

    protected $casts = [
        'recordedat' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function template()
    {
        return $this->belongsTo(MemoryCueTemplate::class, 'memorycuetemplateid');
    }
}
