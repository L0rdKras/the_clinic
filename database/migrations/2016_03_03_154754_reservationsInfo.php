<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservationsInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservationsInfo', function (Blueprint $table) {
            $table->increments('id');
            $table->date('reservationDate');
            $table->integer('block_id')->unsigned();
            $table->integer('reservation_id')->unsigned();
            /*$table->integer('patient_id')->unsigned();
            $table->integer('medic_id')->unsigned();
            $table->integer('atention_id')->unsigned();
            $table->time('start_hour');
            $table->time('finish_hour');
            $table->enum('status',['Reservada','Confirmada','Concretada','Cancelada','Ausente']);*/
            $table->timestamps();

            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('reservation_id')->references('id')->on('reservations');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reservationsInfo');
    }
}
