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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->decimal('total',10,2);
            $table->unsignedBigInteger('order');
            $table->unsignedBigInteger('cashier');
            $table->timestamps();

            $table->foreign('cashier')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
