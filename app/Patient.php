<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

	//
	protected $table = 'patients';

	protected $fillable = ['firstname','lastname','address','rut','phone','email','type','company_id'];

	public function Company()
	{
		return $this->belongsTo('App\Company');
	}

	public function relationships()
	{
		//return $this->hasMany('App\Patients');
	}

}