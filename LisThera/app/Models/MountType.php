<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MountType extends Model
{
    protected $table = 'mounttypes';
    protected $primaryKey = 'mounttypeid';
    public $timestamps = false;

    protected $fillable = ['name', 'description'];
}
