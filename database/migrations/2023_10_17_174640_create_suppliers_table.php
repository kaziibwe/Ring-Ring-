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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
            ->nullable();
            $table->string('name');
            $table->string('number');
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('street');
            $table->string('division');
            $table->string('city');
            $table->string('country');
            $table->string('product');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};


// php artisan serve --host=172.168.9.249 --port=8000
