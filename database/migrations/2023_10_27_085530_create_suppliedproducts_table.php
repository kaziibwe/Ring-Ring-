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
        Schema::create('suppliedproducts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supply_id')->constrained()->references('id')->on('supplies')->onDelete('cascade');
            $table->string('product_name');
            $table->string('quantity');
            $table->string('photo')->nullable();
            $table->string('price');
            $table->string('supply_status')->nullable();
            $table->string('item_sizes')->nullable();
            $table->string('item_colors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliedproducts');
    }
};
