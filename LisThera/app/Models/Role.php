<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'roleid';
    public $timestamps = false;

    protected $fillable = ['rolename', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'userroles', 'roleid', 'userid');
    }
}
