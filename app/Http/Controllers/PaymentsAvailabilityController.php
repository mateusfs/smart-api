<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payments;

/**
 * @resource payments
 */
class PaymentsAvailabilityController extends Controller {
	/**
	 * Buscar Recebimento
	 *
	 * Buscar Recebimento | Exemplo: api/v1/payments/1
	 *
	 * @param number $prc_id        	
	 */
	public function index($prc_id) {
		return Payments::where ( 'prc_id', $prc_id )->firstOrFail ();
	}
	
	/**
	 * Criar Recebimento
	 *
	 * Criar Recebimento | Exemplo: api/v1/payments/criar
	 *
	 * @return void
	 */
	public function criar(Request $request) {
		return Payments::created ( $request );
	}
	
	/**
	 * Atualizar Recebimento
	 *
	 * Atualizar Recebimento | Exemplo: api/v1/payments/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request) {
		return Payments::updated ( $request );
	}
	
	/**
	 * Remover Recebimento
	 *
	 * Remover Recebimento | Exemplo: api/v1/payments/delete/1
	 *
	 * @param number $prc_id        	
	 *
	 * @return int
	 */
	public function delete($prc_id) {
		$payment = Payments::where ( 'prc_id', $prc_id )->firstOrFail ();
		if ($payment) {
			$payment->delete ();
		}
	}
}
