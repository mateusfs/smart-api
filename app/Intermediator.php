<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intermediator extends Model
{
	protected $table = 'intermediator';
	protected $primaryKey = 'int_id';
	
	protected $fillable = [
			'int_id',
			'int_title'
	];

}



