<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    protected $fillable = ['username', 'password', 'is_admin'];

    protected $hidden = ['password'];

    protected $casts = ['is_admin' => 'boolean'];
}
