<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
    protected $table = 'budgetDetails';

	protected $fillable = ['price','budget_id','atention_id'];
}
