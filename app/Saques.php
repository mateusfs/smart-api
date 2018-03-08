<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saques extends Model
{
	protected $table = 'withdrawals';
	protected $primaryKey = 'saq_id';
	
	protected $fillable = [
			'saq_id',
			'saq_carteira',
			'saq_criado_em',
			'saq_valor',
			'saq_status',
			'saq_intermediario',
			'saq_intermediario_code',
			'saq_pago_em'
	];
}


