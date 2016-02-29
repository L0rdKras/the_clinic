<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Medic extends Model {

	//
	protected $table = 'medics';

	protected $fillable = ['name','speciality'];

}