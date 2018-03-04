<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayerAddressIugu extends Model
{
    public $street;
    public $number;
    public $district;
    public $city;
    public $state;
    public $zip_code;
    public $complement;
    
}

