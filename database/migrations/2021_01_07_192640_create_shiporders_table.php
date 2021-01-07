<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporders', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id')->unsigned();
            $table->string('shipto_name');
            $table->string('shipto_address');
            $table->string('shipto_city');
            $table->string('shipto_country');
            $table->timestamps();

            $table->foreign('person_id')->references('id')->on('people')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shiporders');
    }
}
