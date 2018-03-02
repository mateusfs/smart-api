<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saques;

class SaquesController extends Controller
{
	public function index($saq_id)
	{
		return Saques::where('saq_id', $saq_id)->firstOrFail();
	}
}
