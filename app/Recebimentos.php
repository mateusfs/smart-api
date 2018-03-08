<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recebimentos extends Model
{
	protected $table = 'payments_availability';
	protected $primaryKey = 'prc_id';
	
	protected $fillable = [
			'prc_id',
			'prc_local',
			'prc_carteira',
			'prc_pagamento',
			'prc_valor',
			'prc_numero',
			'prc_disponivel_em',
			'prc_disponibilizada',
			'prc_status',
			'prc_intermediario_taxa',
			'prc_empresa',
			'prc_cliente'
	];
}


