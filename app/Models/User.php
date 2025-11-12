<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username', 'password', 'full_name', 'email',
        'phone_number', 'address', 'role'
    ];

    protected $hidden = ['password'];

    // Relasi
    public function rentals()
    {
        return $this->hasMany(Rental::class, 'user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Buy::class, 'user_id', 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id', 'user_id');
    }
}