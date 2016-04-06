<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Block;
use App\Atention;
use App\Reservation;
use App\ReservationInfo;

class ShedulleController extends Controller
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
        //
        return view('shedulle.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blocks = Block::all();
        $today = date("Y-m-d");
        return view('shedulle.register',compact('today','blocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['reservationDate','patient_id','medic_id','atention_id','comment']);

        $data = $request->only(['reservationDate','room','patient_id','medic_id','atention_id','block_id']);

        $atention = Atention::find($input['atention_id']);

        $rules = [
                'reservationDate'=>'required',
                'patient_id'=>'required',
                'medic_id'=>'required',
                'atention_id'=>'required',
            ];

        $validation = \Validator::make($input,$rules);

        if($validation->passes())
        {
            $reservation = new Reservation($input);

            $reservation->save();

            $id_reservation = $reservation->id;

            $numberOfBlocks = $atention->block_numbers;

            for ($i=0; $i < $numberOfBlocks; $i++) { 
                
                $nextBlock = $data['block_id']+$i;

                $insertData = [
                    'reservationDate' => $data['reservationDate'],
                    'room' => $data['room'],
                    'block_id' => $nextBlock,
                    'reservation_id' => $id_reservation
                ];

                $info = new ReservationInfo($insertData);

                $info->save();
                
            }

            return response()->json(["respuesta"=>"Guardado"]);
        }

        $messages = $validation->errors();

        return response()->json($messages);

        //return $input;
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

    public function dataSelection($room,$block,$year,$month,$day,$atention,$medic)
    {
        $date = $year."-".$month."-".$day;

        $checkRoom = ReservationInfo::where('reservationDate','=',$date)->where('block_id','=',$block)->where('room','=',$room)->count();

        if($checkRoom == 0){
            //revisar si el medico tiene ocupada esas horas
            $findMedicConflict = Reservation::where('medic_id',$medic)->where('reservationDate',$date)->get();

            $checkMedic = 0;

            foreach ($findMedicConflict as $register) {
                $checkMedic+=$register->ReservationsInfo->where('block_id',$block)->count();
            }

            if($checkMedic == 0)
            {
                //
                $atention = Atention::find($atention);

                $numberOfBlocks = $atention->block_numbers;

                for ($i=1; $i < $numberOfBlocks; $i++) { 
                    $nextBlock = $block+$i;
                    $checkRoom = ReservationInfo::where('reservationDate','=',$date)->where('block_id','=',$nextBlock)->where('room','=',$room)->count();
                    if($checkRoom > 0){
                        //cortar con un return, ya que hay una hora tomada despues
                        //que impide hacer la reserva en el bloque seleccionado
                        return response()->json(['estado'=>'invalido','mensaje'=>'La sala esta ocupada']);
                    }
                    
                    $checkMedic = 0;

                    foreach ($findMedicConflict as $register) {
                        $checkMedic+=$register->ReservationsInfo->where('block_id',$nextBlock)->count();
                    }
                    if($checkMedic>0){
                        //medico ocupado
                        return response()->json(['estado'=>'invalido','mensaje'=>'El medico esta ocupado en uno de los bloques']);
                    }
                }
                $initialBlock = Block::find($block);

                $lastBlockId = $block+$numberOfBlocks-1;

                $encontro = false;

                $lastBlock;

                while($encontro == false){

                    if(!$lastBlock = Block::find($lastBlockId)){
                        $lastBlockId--;
                    }else{
                        $encontro = true;
                    }
                }

                $respuesta = [
                    'estado'=>'valido',
                    'inicio'=>$initialBlock->startBlock,
                    'fin'=>$lastBlock->finishBlock,
                    'bloques'=>$numberOfBlocks,
                    'blolqueInicial'=>$initialBlock->id,
                    'bloqueFinal'=>$lastBlock->id
                ];

                return response()->json($respuesta);

            }else{
                //el medico esta ocupado en ese bloque
                return response()->json(['estado'=>'invalido','mensaje'=>'El medico esta ocupado a esa hora']);
            }
        }else{
            //la sala esta ocupada en ese horario
            return response()->json(['estado'=>'invalido','mensaje'=>'La sala esta ocupada a esa hora']);
        }
    }

    public function prueba(){
        //
        $date = '2016-04-05';
        $room = 1;

        $blocks = Block::all();

        $data = ReservationInfo::where('reservationDate',$date)->where('room',$room)->get();

        //dd($data->where('block_id',1)->isEmpty());

        $filas ="";

        foreach ($blocks as $block) {
            if(!$data->where('block_id',$block->id)->isEmpty()){
                $info = $data->where('block_id',$block->id)->first();

                //dd($info->Reservation->Patient);
                $filas.="
                <tr id='".$block->id."' data-id-block='".$block->id."' data-reservation-id='".$info->Reservation->id."' class='filaAgenda'>
                    <th>".$block->startBlock." a ".$block->finishBlock."</th>
                    <th>".$info->Reservation->Patient->firstname." ".$info->Reservation->Patient->lastname."</th>
                    <th>".$info->Reservation->Atention->name."</th>
                    <th><a href='#' class='btn btn-info infoBloque'>+ Info</a></th>
                </tr>";
            }else{
                $filas.="
                <tr id='".$block->id."' data-id-block='".$block->id."' data-reservation-id='0' class='filaAgenda'>
                    <th>".$block->startBlock." a ".$block->finishBlock."</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>";
            }
        }

        echo $filas;

    }

    public function dataOfDayInRoom($year,$month,$day,$room){
        //$data = ReservationInfo::where('reservationDate',$date)->get();
        $date = $year."-".$month."-".$day;
        $blocks = Block::all();

        $data = ReservationInfo::where('reservationDate',$date)->where('room',$room)->get();

        $filas ="";

        foreach ($blocks as $block) {
            if(!$data->where('block_id',$block->id)->isEmpty()){
                $info = $data->where('block_id',$block->id)->first();

                //dd($info->Reservation->Patient);
                $filas.="
                <tr id='".$block->id."' data-id-block='".$block->id."' data-reservation-id='".$info->Reservation->id."' class='filaAgenda'>
                    <th>".$block->startBlock." a ".$block->finishBlock."</th>
                    <th>".$info->Reservation->Patient->firstname." ".$info->Reservation->Patient->lastname."</th>
                    <th>".$info->Reservation->Atention->name."</th>
                    <th><a href='#' class='btn btn-info infoBloque'>+ Info</a></th>
                </tr>";
            }else{
                $filas.="
                <tr id='".$block->id."' data-id-block='".$block->id."' data-reservation-id='0' class='filaAgenda'>
                    <th>".$block->startBlock." a ".$block->finishBlock."</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>";
            }
        }

        return $filas;
    }
}
