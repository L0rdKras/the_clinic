<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

	//
	protected $table = 'reservations';

	protected $fillable = ['reservationDate','patient_id','medic_id','atention_id','status','comment'];

	public function ReservationsInfo()
	{
		return $this->hasMany('App\ReservationInfo');
	}

	public function Medic()
	{
		return $this->belongsTo('App\Medic');
	}

	public function Patient()
	{
		return $this->belongsTo('App\Patient');
	}

	public function Atention()
	{
		return $this->belongsTo('App\Atention');
	}

}