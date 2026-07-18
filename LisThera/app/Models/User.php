<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'userid';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'passwordhash',
        'email',
        'isactive',
    ];

    protected $hidden = [
        'passwordhash',
    ];

    // Relacionamentos
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'userroles', 'userid', 'roleid');
    }

    public function therapist()
    {
        return $this->hasOne(Therapist::class, 'userid', 'userid');
    }
}
