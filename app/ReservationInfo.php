<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationInfo extends Model {

	//
	protected $table = 'reservationsInfo';

	protected $fillable = ['reservationDate','block_id','reservation_id'];

}