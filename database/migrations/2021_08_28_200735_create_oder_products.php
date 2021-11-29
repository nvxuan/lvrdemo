<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oder_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('oder_id');
            $table->integer('quantity')->default(0);
            $table->string('name');
            $table->double('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oder_products');
    }
}