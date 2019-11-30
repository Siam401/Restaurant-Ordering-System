<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice')->nullable();
            $table->string('tableno')->nullable();
            $table->string('setname')->nullable();
            $table->string('item')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('price')->nullable();
            $table->integer('sl')->nullable();
            $table->integer('status')->default(0);
            $table->integer('billcomplete')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transections');
    }
}
