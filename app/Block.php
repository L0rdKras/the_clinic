<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model {

	//
	protected $table = 'blocks';

	protected $fillable = ['startBlock','finishBlock'];

	/*public function supplier()
	{
		return $this->belongsTo('App\Supplier');
	}*/

	public function Reservations()
	{
		//return $this->hasMany('App\Patients');
	}

}