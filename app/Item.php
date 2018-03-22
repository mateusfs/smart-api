<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $table = 'orders_items';
	protected $primaryKey = 'oit_id';
	
	protected $fillable = [
			'oit_id',
			'oit_pedido',
			'oit_titulo',
			'oit_tipo',
			'oit_tipo_id',
			'oit_quantidade',
			'oit_valor'
	];
}
