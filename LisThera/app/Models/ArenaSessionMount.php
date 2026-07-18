<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArenaSessionMount extends Model
{
    protected $table = 'arenasessionmounts';
    protected $primaryKey = 'mountid';
    public $timestamps = false;

    protected $fillable = [
        'arenasessionid',
        'horseid',
        'mounttypeid',
        'posture',
        'startedat',
        'endedat',
    ];

    public function session()
    {
        return $this->belongsTo(ArenaSession::class, 'arenasessionid', 'arenasessionid');
    }

    public function horse()
    {
        return $this->belongsTo(Horse::class, 'horseid', 'horseid');
    }

    public function mountType()
    {
        return $this->belongsTo(MountType::class, 'mounttypeid', 'mounttypeid');
    }
}
