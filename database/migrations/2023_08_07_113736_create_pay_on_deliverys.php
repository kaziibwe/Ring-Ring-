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
        Schema::create('pay_on_deliverys', function (Blueprint $table) {
            $table->id();
            $table->string('means');
            $table->string('image');
            $table->double('price',10,2);
            $table->unsignedInteger('quantity');
            $table->double('total',10,2);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_on_deliverys');
    }
};
