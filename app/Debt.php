<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    //
    protected $table = 'debts';

	protected $fillable = ['total','patient_id','budget_id','date'];
}
