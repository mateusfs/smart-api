<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
	protected $table = 'debts';
	protected $primaryKey = 'dbt_id';
	public $timestamps  = false;

	protected $fillable = [
			'dbt_id',
			'dbt_order_id',
			'dbt_value',
			'dbt_value_quota',
			'dbt_value_fee',
			'dbt_due_at',
			'dbt_accept_until',
			'dbt_accept_after',
			'dbt_accept_fee',
			'dbt_accept_creditcard',
			'dbt_accept_billet',
			'dbt_nota',
			'dbt_cancel_order',
			'dbt_created_at',
			'dbt_updated_at',
			'dbt_deleted_at'
	];
}
