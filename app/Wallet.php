<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

    protected $table = 'wallets';

    protected $primaryKey = 'wal_id';

    public $timestamps = false;

    protected $fillable = [
        'wal_title',
        'wal_key',
        'wal_secret',
        'wal_pin',
        'wal_saque_automatico',
        'wal_multas',
        'wal_antecipacao',
        'wal_antecipacao_tipo',
        'wal_antecipacao_dias',
        'wal_soft_descriptor',
        'wal_pacelamento_max',
        'wal_aceitar_boleto',
        'wal_aceitar_cartao',
        'wal_cartao_comissao_taxa',
        'wal_cartao_comissao_fixo',
        'wal_taxa_cartao_antecipacao',
        'wal_banco',
        'wal_agencia',
        'wal_conta',
        'wal_intermediary',
        'wal_intermediary_settings'
    ];

    protected $hidden = [
        'wal_id'
    ];
}
