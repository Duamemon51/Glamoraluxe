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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
        
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('country');
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('state');
            $table->string('postal_code');
            $table->string('email');
            $table->string('phone');
        
            $table->boolean('ship_to_different_address')->default(false);
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_company_name')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_apartment')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_postal_code')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
        
            $table->text('order_notes')->nullable();
            $table->string('coupon_code')->nullable();
        
            $table->decimal('total_price', 10, 2);
        
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
