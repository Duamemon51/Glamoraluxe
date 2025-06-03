<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();  // cart_id (auto-increment)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key referencing products table
            $table->integer('quantity')->default(1); // Quantity of product
            $table->decimal('price', 10, 2); // Price of the product
            $table->decimal('total', 10, 2)->computedAs('quantity * price'); // Total price (calculated field)
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
