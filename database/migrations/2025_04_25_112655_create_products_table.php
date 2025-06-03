<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Product name
            $table->text('description'); // Product description
            $table->decimal('price', 10, 2); // Product price
            $table->unsignedBigInteger('category_id'); // Foreign key for categories
            $table->string('size')->nullable(); // Size (if applicable)
            $table->string('color')->nullable(); // Color
            $table->string('image_url'); // Image URL or path
            $table->integer('stock_quantity'); // Quantity in stock
            $table->enum('status', ['in_stock', 'out_of_stock'])->default('in_stock'); // Product status
            $table->timestamps(); // Created at and updated at
        
            // Foreign key constraint for category_id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
