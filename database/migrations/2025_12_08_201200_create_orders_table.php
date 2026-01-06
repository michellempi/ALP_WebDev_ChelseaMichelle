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
            $table->id('order_id');

            // FK
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_book_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('shipping_method_id');
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('promo_id')->nullable();

            $table->date('order_date');
            $table->time('order_time');
            $table->decimal('total_amount', 12, 2);
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('address_book_id')->references('address_id')->on('addressBooks')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('paymentMethods');
            $table->foreign('shipping_method_id')->references('shipping_method_id')->on('shippingMethods');
            $table->foreign('order_status_id')->references('orderStatus_id')->on('orderStatus')->onDelete('cascade');
            $table->foreign('promo_id')->references('promo_id')->on('promos')->onDelete('set null');
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
