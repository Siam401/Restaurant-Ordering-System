<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemingredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itemid')->unsigned();
            $table->integer('ingredientid')->nullable();
            $table->integer('ingredientunit')->nullable();
            $table->integer('ingredientquantity')->nullable();
            $table->string('packageid')->nullable();
            $table->integer('packagequantity')->nullable();
            $table->timestamps();

            $table->foreign('itemid')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemingredients');
    }
}
