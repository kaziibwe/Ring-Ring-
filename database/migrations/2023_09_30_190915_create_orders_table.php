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
            $table->foreignId('customer_id')->constrained()->references('id')->on('customers')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->string('street');
            $table->string('division');
            $table->string('city');
            $table->string('tracking_no');
            $table->string('payment_mode')->nullable();
            $table->string('Order_status');
            $table->string('Order_number')->nullable();
            $table->string('payment_id')->nullable();
            $table->decimal('shipping_fee',10,2);
            $table->decimal('calculated_total',10,2);
            $table->string('orderdate');
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
