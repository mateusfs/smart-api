<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	protected $table = 'fees';
	protected $primaryKey = 'dbt_id';
	public $timestamps  = false;

	protected $fillable = [
			'fee_id',
			'fee_wallet_id',
			'fee_debt_id',
			'fee_payment_id',
			'fee_datetime',
			'fee_value',
			'fee_created_at',
			'fee_to',
			'fee_description',
	];
}
