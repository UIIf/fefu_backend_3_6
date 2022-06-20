<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->cascadeOnDelete();
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->unsignedDouble('price_total', 16, 2);
            $table->unsignedDouble('price_item', 16, 2);
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->unique(['cart_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};