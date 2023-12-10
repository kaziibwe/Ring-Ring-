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
        Schema::create('deliverymen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')
            ->nullable()
            ->constrained('admins')
            ->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->string('number');
            $table->string('image')->nullable();
            $table->string('ninfront')->nullable();
            $table->string('ninback')->nullable();
            $table->string('NIN');
            $table->string('street');
            $table->string('division');
            $table->string('city');
            $table->string('country');
            $table->string('password');
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
        Schema::dropIfExists('deliverymen');
    }
};
