<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;

class CompanyController extends Controller
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
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $months = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        return view('company.registerForm',compact('months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name','rut','phone','email','benefit','amount','month']);

        $count = Company::where('rut','=', $input['rut'])->count();

        if($count == 0)
        {
            //
            $rules = [
                    'name'=>'required',
                    'rut'=>'required',
                    'phone'=>'required',
                    'email'=>'required|email',
                    'benefit'=>'required|numeric',
                    'amount'=>'required|numeric',
                    'month'=>'required|numeric|min:1'
                ];

            $validation = \Validator::make($input,$rules);

            if($validation->passes())
            {
                $company = new Company($input);

                $company->save();

                return response()->json(["respuesta"=>"Guardado"]);
            }

            $messages = $validation->errors();

            return response()->json($messages);
        }

        return response()->json(["respuesta"=>"Ese rut ya esta registrado"]);

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
        if($company = Company::find($id)){
          $months = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
          return view('company.edit',compact('months','company'));
        }

        return abort(404);

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
      $input = $request->only(['name','rut','phone','email','benefit','amount','month']);

      $rules = [
              'name'=>'required',
              'rut'=>'required',
              'phone'=>'required',
              'email'=>'required|email',
              'benefit'=>'required|numeric',
              'amount'=>'required|numeric',
              'month'=>'required|numeric|min:1'
          ];

      $validation = \Validator::make($input,$rules);

      if($validation->passes())
      {
          $company = Company::find($id);

          $company->name = $input['name'];
          $company->rut = $input['rut'];
          $company->phone = $input['phone'];
          $company->email = $input['email'];
          $company->benefit = $input['benefit'];
          $company->amount = $input['amount'];
          $company->month = $input['month'];

          $company->save();

          //return response()->json(["respuesta"=>"Guardado"]);
          return back()->with("message","Empresa Actualizada");
      }

      $messages = $validation->errors();

      //return response()->json($messages);
      return back()->withErrors($messages);
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

    public function companys_list()
    {
        $companys = Company::orderBy('name')->paginate(10);

        return view('company.list',compact('companys'));
    }
}
