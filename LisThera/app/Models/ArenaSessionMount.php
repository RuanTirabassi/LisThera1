<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSessionMount extends Model
{
    protected $table = 'arenasessionmounts';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid', 'horseid', 'mounttypeid',
        'mountedat', 'dismountedat', 'notes',
    ];

    protected $casts = [
        'mountedat'    => 'datetime',
        'dismountedat' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid');
    }

    public function horse()
    {
        return $this->belongsTo(Horse::class, 'horseid');
    }

    public function mountType()
    {
        return $this->belongsTo(MountType::class, 'mounttypeid');
    }
}
