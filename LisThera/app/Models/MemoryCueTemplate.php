<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryCueTemplate extends Model
{
    protected $table = 'memorycuetemplates';
    protected $primaryKey = 'templateid';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'specialty',
        'hotkey',
        'description',
        'isactive',
    ];

    public function events()
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'templateid', 'templateid');
    }
}
