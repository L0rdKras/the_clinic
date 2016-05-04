<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets';

	protected $fillable = ['total_atentions','discount','total','status','patient_id','company_id','medic_id','user_id'];

	public function Patient(){
		return $this->belongsTo('App\Patient');
	}

	public function Medic(){
		return $this->belongsTo('App\Medic');
	}

	public function Company(){
		return $this->belongsTo('App\Company');
	}

	public function User(){
		return $this->belongsTo('App\User');
	}

	public function BudgetDetails(){
		return $this->hasMany('App\BudgetDetail');
	}
}
