<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoatColor extends Model
{
    protected $table = 'coat_colors';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function horses()
    {
        return $this->hasMany(Horse::class, 'coat_color_id');
    }
}
