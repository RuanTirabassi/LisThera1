<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Therapist extends Model
{
    protected $table = 'therapists';
    public $timestamps = false;

    protected $fillable = [
        'fullname', 'specialization', 'registrationnumber',
        'phonenumber', 'email',
    ];

    public function arenaSessions()
    {
        return $this->hasMany(ArenaSession::class, 'therapistid');
    }
}
