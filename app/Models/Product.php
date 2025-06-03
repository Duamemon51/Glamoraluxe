<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';  // Table name
protected $fillable = [
    'name', 
    'description', 
    'price', 
    'category_id', 
    'size', 
    'color', 
    'image_url', 
    'stock_quantity', 
    'status',
    'rating',
    'is_new',           // <-- Add this
    'is_feature',       // <-- Add this
];

     // Define mass-assignable attributes

    // Relationship with Category (assuming you have a Category model)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Tags (many-to-many)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
}
