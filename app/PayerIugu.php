<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayerIugu extends Model
{
    public $cpf_cnpj;
    public $name;
    public $phone_prefix;
    public $phone;
    public $email;
}
