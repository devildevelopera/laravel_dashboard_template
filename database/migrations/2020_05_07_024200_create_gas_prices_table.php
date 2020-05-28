<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gas_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('station_id');
            $table->double('price_regular',8,2);
            $table->double('price_mid',8,2);
            $table->double('price_premium',8,2);
            $table->double('price_diesel',8,2);
            $table->dateTime('updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gas_prices');
    }
}
