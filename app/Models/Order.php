<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'company_name', 'country', 'address', 
        'apartment', 'state', 'postal_code', 'email', 'phone', 'ship_to_different_address', 
        'shipping_first_name', 'shipping_last_name', 'shipping_company_name', 'shipping_country', 
        'shipping_address', 'shipping_apartment', 'shipping_state', 'shipping_postal_code', 
        'shipping_email', 'shipping_phone', 'order_notes', 'coupon_code', 'total_price', 
        'payment_status', 'order_status', 'payment_method',
    
     'user_id'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
{
    return $this->hasMany(OrderItem::class);
}

}
