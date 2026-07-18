<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorseClinicalNote extends Model
{
    protected $table = 'horseclinicalnotes';
    protected $primaryKey = 'noteид';
    public $timestamps = false;

    protected $fillable = [
        'horseid',
        'note',
        'recordedat',
        'recordedby',
    ];

    public function horse()
    {
        return $this->belongsTo(Horse::class, 'horseid', 'horseid');
    }
}
