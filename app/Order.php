<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    protected $primaryKey = 'ord_id';

    public $timestamps = false;

    protected $fillable = [
        'ord_carteira',
        'ord_aceitar_boleto',
        'ord_aceitar_cartao',
        'ord_aceitar_cartao_parcelas',
        'ord_status',
        'ord_emails',
        'ord_pagamento_minimo',
        'ord_criado_em',
        'ord_atualizar',
        'ord_vencimento',
        'ord_receber_ate',
        'ord_multa_atraso',
        'ord_juros_dia',
        'ord_entrega',
        'ord_nome',
        'ord_email',
        'ord_celular'
    ];

    protected $hidden = [
        'ord_id'
    ];
}



