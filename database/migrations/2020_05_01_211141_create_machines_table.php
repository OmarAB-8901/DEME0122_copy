<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idgroup')->unsigned();
            $table->string('name', 30);
            $table->boolean('activar_oee')->default(0);
            $table->boolean('activar_eventos')->default(0);
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('idgroup')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
}
