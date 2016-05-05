<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;
use App\Patient;
use App\Relationship;

class PatientsController extends Controller
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
        return view('patients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //muestra formulario
        return view('patients.registerForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['firstname','lastname','address','rut','phone','email','type']);

        $data = $request->only(['dataToSave']);

        $rules = [
                    'firstname'=>'required',
                    'lastname'=>'required',
                    'address'=>'required',
                    'rut'=>'required',
                    'phone'=>'required',
                    'email'=>'required|email',
                    'type'=>'required',
                    'company_id'=>'required|numeric'
                ];

        if($input['type'] == "Titular")
        {
            $input['company_id'] = $data['dataToSave'];

            $validation = \Validator::make($input,$rules);

            if($validation->passes())
            {

                $patient = new Patient($input);

                $patient->save();

                return response()->json(["respuesta"=>"Guardado"]);
            }

            $messages = $validation->errors();

            return response()->json($messages);


        }elseif ($input['type'] == "Carga") {
            $incumbent = Patient::find($data['dataToSave']);

            $input['company_id'] = $incumbent->Company->id;

            $validation = \Validator::make($input,$rules);

            if($validation->passes())
            {

                $patient = new Patient($input);

                $patient->save();

                //crear relacion

                $inputRelationship = ['incumbent'=>$incumbent->id,'burden'=>$patient->id];

                $relationship = new Relationship($inputRelationship);

                $relationship->save();

                return response()->json(["respuesta"=>"Guardado"]);
            }

            $messages = $validation->errors();

            return response()->json($messages);

        }else{
            //error, no especifico el tipo
        }
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
        $patient = Patient::find($id);

        $dataToSave = $patient->company_id;

        if($patient->type==="Carga"){
            $relation = Relationship::where('burden',$id)->first();

            $dataToSave = $relation->incumbent;
        }

        return view('patients.edit',compact('patient','dataToSave'));
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

    public function companysToAdd(){
        $companys = Company::orderBy('name')->get();

        $vista = view('patients.listOfCompanys',compact('companys'));

        return $vista;
    }

    public function incumbentsToAdd(){
        $incumbents = Patient::where('type','=','Titular')->orderBy('firstname')->get();

        $vista = view('patients.listOfIncumbents',compact('incumbents'));

        return $vista;
    }

    public function patients_list()
    {
        $patients = Patient::orderBy('firstname')->paginate(10);

        return view('patients.list',compact('patients'));
    }

    public function listAllPatients()
    {
        $patients = Patient::orderBy('firstname')->get();

        return response()->json($patients);
    }

    public function dataOfPatient($id){
        if($patient = Patient::find($id)){

            $array_response['firstname'] = $patient->firstname;
            $array_response['lastname'] = $patient->lastname;
            $array_response['rut'] = $patient->rut;

            $array_response['companyName'] = $patient->Company->name;

            $array_response['companyBenefit'] = $patient->Company->benefit;

            $array_response['companyAmount'] = $patient->Company->amount;

            return response()->json($array_response);
        }

        return response()->json([]);

    }

}