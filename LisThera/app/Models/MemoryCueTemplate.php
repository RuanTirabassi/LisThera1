<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MemoryCueTemplate extends Model
{
    protected $table = 'memorycuetemplates';
    public $timestamps = false;

    protected $fillable = [
        'therapistid',
        'cuekey',
        'cuelabel',
        'category',
        'polarity',
        'isactive',
    ];

    protected $casts = [
        'isactive'  => 'boolean',
        'createdat' => 'datetime',
        'updatedat' => 'datetime',
    ];

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class, 'therapistid');
    }

    public function sessionMemoryCueEvents(): HasMany
    {
        return $this->hasMany(SessionMemoryCueEvent::class, 'memorycuetemplateid');
    }
}
