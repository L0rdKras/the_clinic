<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Atention extends Model {

	//
	protected $table = 'atentions';

	protected $fillable = ['name','price','block_numbers'];

}