<?php

namespace App\Http\Controllers;

use App\Carteiras;
use Illuminate\Http\Request;

class CarteirasController extends Controller
{
	public function index($wal_id)
	{
		return Carteiras::where('wal_id', $wal_id)->firstOrFail();
	}
}
