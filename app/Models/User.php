<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Add new fields to the $fillable array
    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'avatar',
    ];

    // Optionally, you can add any hidden attributes that shouldn't be exposed in JSON responses
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Optionally, you can cast attributes like 'avatar' to a specific type, if needed
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // In User model
// In User.php
public function coupon()
{
    return $this->hasOne(Coupon::class);
}


}
