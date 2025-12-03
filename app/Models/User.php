<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable implements CanResetPasswordContract 
{

    use HasFactory;
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
        'google_id',
        'google_avatar',
        'google_token',
        'must_set_password',
        'password_set_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'must_set_password' => 'boolean',
        'password_set_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        // nilai role di DB: admin, customer, dll
        return $this->role === 'admin';
    }

    public function needsPasswordSetup(): bool
    {
        return (bool) $this->must_set_password;
    }
}
