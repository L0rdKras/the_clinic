<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Atention;
use App\Medic;
use App\Patient;
use App\Budget;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('budget.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pacientes
        //atenciones
        //medicos
        return view('budget.createBudget');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $info = $request->only(['detail','total_atentions']);

        $detail = $info['detail'];

        $json = json_decode($detail);

        $input = $request->only(['patient_id','medic_id','total_atentions']);

        $patient = Patient::find($input['patient_id']);

        $discount = $patient->discount($input['total_atentions']);

        $total = $input['total_atentions']-$discount;

        $input['total'] = $total;
        $input['discount'] = $discount;
        $input['company_id'] = $patient->Company->id;
        $input['status'] = "Pendiente";
        $input['user_id'] = $request->user()->id;

        $budget = new Budget($input);

        $budget->save();

        dd($budget);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculate($id,$total){
        $patient = Patient::find($id);

        $benefit = $patient->Company->benefit;

        $discount = round($total*$benefit/100);

        $totalToPay = $total-$discount;

        return response()->json(compact('discount','totalToPay'));
    }
}
