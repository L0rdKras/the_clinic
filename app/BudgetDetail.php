<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
    protected $table = 'budgetDetails';

	protected $fillable = ['price','budget_id','atention_id'];

	public function Budget(){
		return $this->belongsTo('App\Budget');
	}

	public function Atention(){
		return $this->belongsTo('App\Atention');
	}
}
