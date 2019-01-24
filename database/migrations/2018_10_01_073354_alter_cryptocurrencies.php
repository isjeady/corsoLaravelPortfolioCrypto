<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCryptocurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //php artisan make:migration alter_cryptocurrencies --table=cryptocurrencies
    public function up()
    {
        Schema::table('cryptocurrencies', function (Blueprint $table) {
            $table->float('total',11,4)->after('my_gain')->default(0.0);
            $table->float('current_price',11,4)->after('total')->default(0.0);
            $table->float('current_total',11,4)->after('current_price')->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cryptocurrencies', function (Blueprint $table) {
            //
            $table->dropColumn('total');
            $table->dropColumn('current_price');
            $table->dropColumn('current_total');
        });
    }
}
