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
            $table->decimal('price',10,2);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('Active');
            $table->string('featured') ->nullable();
            $table->integer('numberunit');
            $table->Text('info')->nullable();
            $table->longText('description')->nullable();
            $table->longText('information') ->nullable();
            $table->longText('outline1')->nullable();
            $table->longText('outline2')->nullable();
            $table->timestamps();
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
