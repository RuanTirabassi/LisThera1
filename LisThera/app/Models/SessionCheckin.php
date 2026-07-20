<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCheckin extends Model
{
    protected $table = 'session_checkins';
    public $timestamps = false;

    protected $fillable = [
        'practitioner_id',
        'checked_by',
        'scheduled_at',
        'practitioner_mood_pre',
        'practitioner_weight_pre',
        'practitioner_temp_pre',
        'practitioner_pressure_pre',
        'practitioner_use_sensor',
        'is_authorized_to_ride',
        'denial_reason',
        'cancellation_reason',
        'notes',
    ];

    protected $casts = [
        'scheduled_at'              => 'datetime',
        'practitioner_use_sensor'   => 'boolean',
    ];

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id');
    }

    public function checkedByTherapist()
    {
        return $this->belongsTo(Therapist::class, 'checked_by');
    }

    public function arenaSession()
    {
        return $this->hasOne(ArenaSession::class, 'session_checkin_id');
    }
}
