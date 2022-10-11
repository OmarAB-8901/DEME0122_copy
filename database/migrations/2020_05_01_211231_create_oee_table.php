<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oee', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('idmachine')->unsigned();
            $table->datetime('capturedTime')->nullable();
            $table->float('oee')->nullable();
            $table->float('availability')->nullable();
            $table->integer('runTime')->nullable();
            $table->integer('availableTime')->nullable();
            $table->float('performance')->nullable();
            $table->float('ict')->nullable();
            $table->integer('totalPieces')->nullable();
            $table->float('quality')->nullable();
            $table->integer('goodParts')->nullable();
            $table->string('lotId', 45)->nullable();
            $table->string('partId', 45)->nullable();
            $table->integer('idShift')->nullable();
            //$table->timestamps();

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
        Schema::dropIfExists('oee');
    }
}
