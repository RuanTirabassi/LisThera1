<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisReference extends Model
{
    protected $table = 'diagnosisreference';
    protected $primaryKey = 'diagnosisreferenceid';
    public $timestamps = false;

    protected $fillable = [
        'code',
        'description',
        'category',
    ];
}
