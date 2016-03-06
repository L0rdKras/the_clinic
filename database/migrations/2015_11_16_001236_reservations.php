<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            

            $table->increments('id');
            $table->date('reservationDate');
            $table->integer('room');
            $table->integer('patient_id')->unsigned();
            $table->integer('medic_id')->unsigned();
            $table->integer('atention_id')->unsigned();
            $table->string('status',30)->default('Reservada');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('medic_id')->references('id')->on('medics');
            $table->foreign('atention_id')->references('id')->on('atentions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservations');
    }
}
