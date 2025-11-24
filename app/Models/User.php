<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 
use Illuminate\Auth\Passwords\CanResetPassword; 
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract; 


class User extends Authenticatable implements CanResetPasswordContract 
{

    use Notifiable; 
    use CanResetPassword;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'email',
        'phone_number',
        'address',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        // nilai role di DB: admin, customer, dll
        return $this->role === 'admin';
    }
}
