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
            $table->date('reservation_date');
            $table->integer('patient_id')->unsigned();
            $table->integer('medic_id')->unsigned();
            $table->integer('atention_id')->unsigned();
            $table->time('start_hour');
            $table->time('finish_hour');
            $table->enum('status',['Reservada','Confirmada','Concretada','Cancelada','Ausente']);
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
        Schema::drop('reservations');
    }
}
