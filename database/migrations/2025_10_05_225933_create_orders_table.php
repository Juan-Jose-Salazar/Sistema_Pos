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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->enum('estado', ['pending', 'served','cancelled','delivered'])->default('pending');
            $table->unsignedBigInteger('client');
            $table->unsignedBigInteger('waiter');
            $table->timestamps();

            $table->foreign('client')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('waiter')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
