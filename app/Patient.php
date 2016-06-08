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
	public function Reservations()
	{
		return $this->hasMany('App\Reservation');
	}

	public function relationships()
	{
		//return $this->hasMany('App\Patients');
	}

	public function countInPeriod(){
		$thisMonth = date("m");
		$thisYear = date("Y");

		$company = $this->Company;

		$month = $company->month;

		$init_date = "";
		$finisg_date = "";

		if($month>$thisMonth){
			//
			$year = $thisYear-1;
			$init_date = "$year-$month-01";
			$finisg_date = "$thisYear-$month-01";
		}else{
			//
			$year = $thisYear+1;
			$init_date = "$thisYear-$month-01";
			$finisg_date = "$year-$month-01";
		}

		return 0;
	}

	public function discount($amount){
		$company = $this->Company;

		//revisar cuanto lleva gastado ya de la
		//cobertura

		return round(($amount*$company->benefit)/100);
	}

}
