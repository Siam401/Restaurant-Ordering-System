<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipackages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('packageid');
            $table->string('packagename');
            $table->integer('ingredientid')->unsigned();
            $table->integer('unitid')->unsigned();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('ingredientid')->references('id')->on('ingredients');
            $table->foreign('unitid')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ipackages');
    }
}
