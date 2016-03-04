<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Atention;

class AtentionController extends Controller
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
        return view('atention.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('atention.registerForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['name','block_numbers']);

        $rules = [
                'name'=>'required',
                'block_numbers'=>'required|numeric',
            ];

        $validation = \Validator::make($input,$rules);

        if($validation->passes())
        {
            $atention = new Atention($input);

            $atention->save();

            return response()->json(["respuesta"=>"Guardado"]);
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
    public function atentions_list()
    {
        $atentions = Atention::orderBy('name')->paginate(10);

        return view('atention.list',compact('atentions'));
    }

    public function listAllAtentions()
    {
        $atentions = Atention::orderBy('name')->get();

        return response()->json($atentions);
    }
}
