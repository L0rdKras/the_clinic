<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationInfo extends Model {

	//
	protected $table = 'reservationsInfo';

	protected $fillable = ['reservationDate','room','block_id','reservation_id'];

	public function Reservation()
	{
		return $this->belongsTo('App\Reservation');
	}

	public function Block()
	{
		return $this->belongsTo('App\Block');
	}

}