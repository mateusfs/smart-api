<?php

namespace App\Repositories;

use App\Debt;
use App\Http\Requests\DebtRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class DebtRepository
{
    /**
     * Create a new debt post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
        	return Debt::create($request);
        }

        return response()->json(["error" => "Problems creating a debt"], 403);
    }

    /**
     * Update a new debt post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Debt::save($request);
        }

        return response()->json(["error" => "Problems updating a debt"], 403);
    }

    /**
     * Delete a debt.
     *
     * @param  $request
     * @return Response
     */
    public function delete(Debt $debt)
    {
        if($debt)
        {
            return $debt->delete();
        }
        return response()->json(["error" => "Problems deleting a debt"], 403);
    }

    /**
     * Status of debt.
     *
     * @param  $debt
     * @return string
     */
    public function status()
    {
        // open, partial, paid
    }

    /**
     * Paid of debt.
     *
     * @param  $debt
     * @return true/false
     */
    public function paid()
    {

    }

    /**
     * Installments open of debt.
     *
     * @param  $debt
     * @return true/false
     */
    public function installmentsOpen()
    {

    }

    /**
     * Installments paid of debt.
     *
     * @param  $debt
     * @return true/false
     */
    public function installmentsPaid()
    {

    }

    /**
     * Expired of debt.
     *
     * @param  $debt
     * @return true/false
     */
    public function expired()
    {

    }

    /**
     * Accept after of debt.
     *
     * @param  $debt
     * @return true/false
     */
    public function acceptAfter()
    {

    }

    /**
     * Calcule expired fee of debt.
     *
     * @param  $debt
     * @return true
     */
    public function calcExpiredFee()
    {
        //if acceptAfter()

    }

    /**
     * Validate a debt.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	
    	$v = Validator::make($data, DebtRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}
