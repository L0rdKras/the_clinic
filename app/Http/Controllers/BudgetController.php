<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Atention;
use App\Medic;
use App\Patient;
use App\Budget;
use App\BudgetDetail;
use App\Debt;

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

        $input = $request->only(['patient_id','medic_id','total_atentions']);

        $patient = Patient::find($input['patient_id']);

        $discount = $patient->discount($input['total_atentions']);

        $total = $input['total_atentions']-$discount;

        $input['total'] = $total;
        $input['discount'] = $discount;
        $input['company_id'] = $patient->Company->id;
        $input['status'] = "Pendiente";
        $input['user_id'] = $request->user()->id;

        $rules = [
        'patient_id'=>'required',
        'medic_id'=>'required',
        'total_atentions'=>'required'
        ];

        $validation = \Validator::make($input,$rules);

        if($validation->passes())
        {
            //
            $budget = new Budget($input);

            $budget->save();

            $json = json_decode($detail);

            //return $json;

            foreach ($json as $key => $value) {
                $data_detail = [
                    "price"=>$value->valor,
                    "budget_id"=>$budget->id,
                    "atention_id"=>$value->id
                ];
                //return $value->valor;

                $budgetDetail = new BudgetDetail($data_detail);

                $budgetDetail->save();
            }

            $respuesta = "Guardado";

            $numero = $budget->id;

            return response()->json(compact('respuesta','numero'));
        }

        $messages = $validation->errors();

        return response()->json($messages);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $budget = Budget::find($id);

        return view('budget.show',compact('budget'));
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

    public function listOfBudgets(){
        $budgets = Budget::orderBy('id','desc')->paginate(15);

        return view('budget.list',compact('budgets'));
    }

    public function calculate($id,$total){
        $patient = Patient::find($id);

        $benefit = $patient->Company->benefit;

        $discount = round($total*$benefit/100);

        $totalToPay = $total-$discount;

        return response()->json(compact('discount','totalToPay'));
    }

    public function printBudget($id){
        /*$pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(view('budget.index'));*/
        //$sale = Sale::find($id);
        $view =  \View::make('printTest')->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream();
    }

    public function confirmBudget($id){
        $budget = Budget::find($id);

        $budget->status = "Confirmado";

        $budget->save();

        $today = date("Y-m-d");

        $dataDebt = [
        'total'         => $budget->total,
        'patient_id'    => $budget->Patient->id,
        'budget_id'     => $budget->id,
        'date'          => $today
        ];

        $debt = new Debt($dataDebt);

        $debt->save();

        return "Actualizado";
    }

    public function cancelBudget($id){
        $budget = Budget::find($id);

        $budget->status = "Nulo";

        $budget->save();

        return "Actualizado";
    }
}
