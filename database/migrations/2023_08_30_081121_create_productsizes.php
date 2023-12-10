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
        Schema::create('productsizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->references('id')->on('products')->onDelete('cascade');
            $table->string('itemsizes');
            $table->decimal('itemprice',10,2);
            $table->integer('unities')->nullable();
            $table->string('itemcolors')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productsizes');
    }
};
