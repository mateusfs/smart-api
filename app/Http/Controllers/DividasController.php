<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dividas;

class DividasController extends Controller
{
	public function index($pgm_id)
	{
		return Dividas::where('pgm_id', $pgm_id)->firstOrFail();
	}
}
