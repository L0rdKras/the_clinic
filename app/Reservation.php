<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

	//
	protected $table = 'reservations';

	protected $fillable = ['reservationDate','patient_id','medic_id','atention_id','status'];

}