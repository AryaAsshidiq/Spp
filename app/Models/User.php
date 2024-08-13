<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }
}