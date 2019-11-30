<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdertampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordertamps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setname')->nullable();
            $table->string('itemname')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->integer('itemid')->nullable();
            $table->integer('setitemid')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('ordertamps');
    }
}
