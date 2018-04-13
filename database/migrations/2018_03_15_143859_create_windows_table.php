<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWindowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('windows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wprofiles');
            $table->integer('wtypes');
            $table->string('title');
            $table->integer('count_camers');
            $table->text('table');
            $table->string('range', 50)->nullabe();
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
        Schema::drop('windows');
    }
}
