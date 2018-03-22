<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntermediatorMethod extends Model
{
	protected $table = 'intermediators_methods';
	protected $primaryKey = 'imt_id';
	public $timestamps  = false;

	protected $fillable = [
			'imt_intermediator_id',
			'imt_title',
			'imt_type',
			'imt_fixed',
			'imt_variable'
	];
	
	protected  $hidden = [
			'imt_id',
	];
}
