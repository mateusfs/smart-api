<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itens;

class ItensController extends Controller
{
	public function index($oit_id)
	{
		return Itens::where('oit_id', $oit_id)->firstOrFail();
	}
}
