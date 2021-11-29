<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->double('sub_total'); //tong tien chua thue
            $table->float('tax');
            $table->longText('note');
            $table->string('address');
            $table->string('phone');
            $table->string('name');
            $table->tinyInteger('status')->default(1); //1=pending, 2=processing, 3=sent, 4=received, 5=cancel
            $table->softDeletes();
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
        Schema::dropIfExists('oders');
    }
}