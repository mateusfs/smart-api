<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recebimentos;

class RecebimentosController extends Controller
{
	public function index($prc_id)
	{
		return Recebimentos::where('prc_id', $prc_id)->firstOrFail();
	}
}
