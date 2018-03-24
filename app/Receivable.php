<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Receivable extends Model
{

    protected $table = 'receivables';

    protected $primaryKey = 'rcb_id';

    public $timestamps = false;

    protected $fillable = [
        'rcb_carteira',
        'rcb_pagamento',
        'rcb_valor',
        'rcb_numero',
        'rcb_disponivel_em',
        'rcb_disponibilizada',
        'rcb_status'
    ];

    protected $hidden = [
        'rcb_id'
    ];
}