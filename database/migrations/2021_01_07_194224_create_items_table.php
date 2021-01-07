<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('shiporder_id')->unsigned();
            $table->string('title');
            $table->text('note')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10,2)->default(0);
            $table->timestamps();

            $table->foreign('shiporder_id')->references('id')->on('shiporders')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
