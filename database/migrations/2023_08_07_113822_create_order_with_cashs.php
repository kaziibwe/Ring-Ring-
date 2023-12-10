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
        Schema::create('order_with_cashs', function (Blueprint $table) {
            $table->id();
            $table->string('means');
            $table->string('image');
            $table->double('price',10,2);
            $table->unsignedInteger('quantity');
            $table->decimal('total',10,2);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_with_cashs');
    }
};
