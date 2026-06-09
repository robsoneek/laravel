<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'password', 'is_admin'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['is_admin' => 'boolean'];
}
