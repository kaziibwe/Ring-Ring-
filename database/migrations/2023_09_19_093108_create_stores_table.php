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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
            ->nullable()
            ->constrained('admins')
            ->onDelete('set null');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('street');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('number')->unique();
            $table->string('NIN')->unique();
            $table->string('division');
            $table->string('city');
            $table->string('country');
            $table->string('company');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
