<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debets extends Model
{
	protected $table = 'debets';
	protected $primaryKey = 'pgm_id';
	
	protected $fillable = [
			'pgm_id',
			'pgm_local',
			'pgm_carteira',
			'pgm_pedido',
			'pgm_valor',
			'pgm_parcelas',
			'pgm_parcelas_pagas',
			'pgm_status',
			'pgm_pagador_nome',
			'pgm_pagador_email',
			'pgm_pagador_celular',
			'pgm_pagador_cpf',
			'pgm_pagador_genero',
			'pgm_pagador_nascimento',
			'pgm_pagador_razao',
			'pgm_pagador_cnpj',
			'pgm_metodo',
			'pgm_intermediario',
			'pgm_intermediario_code',
			'pgm_intermediario_status',
			'pgm_intermediario_taxa',
			'pgm_intermediario_total',
			'pgm_intermediario_disponivel',
			'pgm_boleto_url',
			'pgm_boleto_digitavel',
			'pgm_cartao_metodo',
			'pgm_cartao_bandeira',
			'pgm_cartao_numero',
			'pgm_cartao_mes',
			'pgm_cartao_ano',
			'pgm_cartao_nome',
			'pgm_cartao_codigo',
			'pgm_cartao_recobrancas',
			'pgm_endereco_cep',
			'pgm_endereco_cidade',
			'pgm_endereco_estado',
			'pgm_endereco_logradouro',
			'pgm_endereco_numero',
			'pgm_endereco_bairro',
			'pgm_endereco_complemento',
			'pgm_comissao_custo',
			'pgm_comissao_taxa',
			'pgm_comissao_fixo',
			'pgm_comissao_variavel',
			'pgm_comissao_total',
			'pgm_comissao_paga',
			'pgm_criado_em',
			'pgm_pago_em',
			'pgm_cliente_taxa',
			'pgm_cliente_liquido',
			'pgm_disponivel_futuro',
			'pgm_disponivel_liberado',
			'pgm_disponivel_intermediario',
			'pgm_disponivel_empresa',
			'pgm_disponivel_cliente',
	        'pgm_id_cliente_iugu',
	        'pgm_id_cliente_gerencia_net'
	];
}


