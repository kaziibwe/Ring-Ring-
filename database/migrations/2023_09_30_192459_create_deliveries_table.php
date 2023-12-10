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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliveryman_id')
            ->nullable()
            ->constrained('deliverymen')
            ->onDelete('set null');
            $table->foreignId('order_id')
            ->constrained()->references('id')
            ->on('orders')
            ->onDelete('cascade');
            $table->string('selectorderdate')->nullable;
            $table->string('deliveredorderdate')->nullable;
            $table->string('tracking_no')->nullable;
            $table->string('calculated_total')->nullable;
            $table->string('payment_mode')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
