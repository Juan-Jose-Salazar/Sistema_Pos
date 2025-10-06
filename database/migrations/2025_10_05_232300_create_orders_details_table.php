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
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order');
            $table->unsignedBigInteger('product');
            $table->integer('amount');
            $table->decimal('unit_price',10,2);
            $table->decimal('subtotal', 10, 2)->storedAs('amount * unit_price');
            $table->timestamps();

            $table->foreign('order')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product')->references('id')->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
    }
};
