<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaitType extends Model
{
    protected $table = 'gait_types';
    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
