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
            $table->id();
            $table->foreignId('subcategory_id')->constrained()->references('id')->on('subcategories')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->string('colors')->nullable();
            $table->string('priceranges')->nullable();
            $table->string('Active');
            $table->string('featured') ->nullable();
            $table->integer('numberunit')->nullable();
            $table->Text('info')->nullable();
            $table->longText('description')->nullable();
            $table->longText('information') ->nullable();
            $table->longText('outlines')->nullable();
            $table->longText('outline_tags')->nullable();
            $table->decimal('discount',5,3)->nullable();
            $table->foreignId('supplier_id')
            ->nullable()
            ->constrained('suppliers')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    // php artisan serve --host=172.168.9.249 --port=8000


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
