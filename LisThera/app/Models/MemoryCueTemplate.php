<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryCueTemplate extends Model
{
    protected $table = 'memorycuetemplates';
    public $timestamps = false;

    protected $fillable = ['label', 'category', 'description', 'hotkey'];

    public function events()
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'memorycuetemplateid');
    }
}
