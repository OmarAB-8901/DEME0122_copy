<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trends', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('idvariable')->unsigned();
            $table->datetime('date');
            $table->decimal('value',10);
            $table->decimal('highLimit', 10);
            $table->decimal('lowLimit', 10);
            //$table->timestamps();

            $table->foreign('idvariable')->references('id')->on('variables');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trends');
    }
}
