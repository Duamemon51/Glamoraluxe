<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // Specify the table name if it's different from the default

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
   // In Cart.php model
public static function subtotal($userId)
{
    return self::where('user_id', $userId)->sum('total');
}

}


