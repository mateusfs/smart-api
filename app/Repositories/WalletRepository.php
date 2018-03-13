<?php

namespace App\Repositories;

use App\Wallet;

class WalletRepository
{
    public function create()
    {
            //true false
    }

    public function update()
    {
            //true false
    }

    public function calcReceivables($method='total',$data_ini=null,$data_fin=null)
    {
        // disponivel e futuros
    }

    public function calcFeesTo($to='intermadiator')
    {
        // intermadiator | system
    }

    public function calcBalance($who='owner')
    {
        
    }

    public function withDraw()
    {
        // verificar saldo dele(cliente)
        // automatizar o saque
    }



}
