<?php

// app/Models/Coupon.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons'; 
    protected $fillable = [
        'user_id',
        'code',
        'type',
        'value',
        'expires_at',
        'is_active',
    ];
    

    protected $dates = ['expires_at'];

    // If needed, define relationships (e.g., a coupon belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
