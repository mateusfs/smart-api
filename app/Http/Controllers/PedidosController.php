<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;

class PedidosController extends Controller
{
	public function index($ord_id)
	{
		return Pedidos::where('ord_id', $ord_id)->firstOrFail();
	}
}
