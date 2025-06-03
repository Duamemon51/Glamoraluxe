<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['name', 'image'];  // Added 'image' to the fillable fields

    // Relationship with products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
