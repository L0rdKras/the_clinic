<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $table = 'budgets';

	protected $fillable = ['total_atentions','discount','total','status','patient_id','company_id','medic_id','user_id'];
}
