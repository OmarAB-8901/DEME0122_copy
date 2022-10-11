<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('ideventoPLC', 82)->nullable();
            $table->integer('idmachine')->unsigned();
            $table->datetime('startTime');
            $table->datetime('endTime')->nullable();
            $table->integer('type');
            $table->string('descriptions', 100);
            $table->string('justification', 100)->nullable();
            $table->integer('duration')->nullable();
            $table->integer('id_plc')->nullable();

            $table->foreign('idmachine')->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
