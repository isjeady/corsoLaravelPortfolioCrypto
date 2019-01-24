<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cryptocurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cryptocurrencies', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name_id')->default('');
            $table->string('name')->default('');

            $table->string('symbol')->default('');
            $table->string('site_store')->default('');

            $table->float('my_token',11,4)->default(0.0);
            $table->float('price',11,4)->default(0.0);
            
            $table->boolean('my_price')->default(false);
            $table->float('my_gain',11,4)->default(0.0);

            $table->integer('percent_change_24h')->default(0);
            $table->integer('percent_change_7d')->default(0);

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
        //
        Schema::dropIfExists('cryptocurrencies');
    }
}
