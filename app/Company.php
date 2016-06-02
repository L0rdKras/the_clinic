<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	//
	protected $table = 'companys';

	protected $fillable = ['name','rut','phone','email','benefit','amount','month'];

	/*public function supplier()
	{
		return $this->belongsTo('App\Supplier');
	}*/

	public function Patiens()
	{
		//return $this->hasMany('App\Patients');
	}

}
