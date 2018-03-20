<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'receivables';
	protected $primaryKey = 'rcb_id';

	protected $fillable = [
			'rcb_id',
			'rcb_local',
			'rcb_carteira',
			'rcb_pagamento',
			'rcb_valor',
			'rcb_numero',
			'rcb_disponivel_em',
			'rcb_disponibilizada',
			'rcb_status',
			'rcb_intermediario_taxa',
			'rcb_empresa',
			'rcb_cliente'
	];
}
