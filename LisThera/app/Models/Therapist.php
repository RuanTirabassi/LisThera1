<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    protected $table = 'therapists';
    protected $primaryKey = 'therapistid';
    public $timestamps = false;

    protected $fillable = [
        'userid',
        'fullname',
        'specialty',
        'registrationnumber',
        'isactive',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid', 'userid');
    }

    public function dailyCheckins()
    {
        return $this->hasMany(DailyCheckin::class, 'therapistid', 'therapistid');
    }

    public function arenaSessions()
    {
        return $this->hasMany(ArenaSessionEntity::class, 'therapistid', 'therapistid');
    }
}
