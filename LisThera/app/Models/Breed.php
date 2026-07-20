<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    protected $table = 'breeds';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function horses()
    {
        return $this->hasMany(Horse::class, 'breed_id');
    }
}
