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
        //
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
            $dataReservationInfo = ReservationInfo::where('reservationDate','=',$date)->where('room','!=',$room)->where('block_id','=',$block)->get();
            $checkMedic = Reservation::where('medic_id','=',$medic)
                            ->join('reservationsInfo','reservations.id','=','reservationsInfo.reservation_id')
                            ->count();
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
                    }
                    $dataReservationInfo = ReservationInfo::where('reservationDate','=',$date)->where('room','!=',$room)->where('block_id','=',$nextBlock)->get();
                    $checkMedic = Reservation::where('medic_id','=',$medic)
                                    ->join('reservationsInfo','reservations.id','=','reservationsInfo.reservation_id')
                                    ->count();
                    if($checkMedic>0){
                        //medico ocupado
                    }
                }
                $initialBlock = Block::find($block);

                $lastBlockId = $block+$numberOfBlocks;

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
                    'final'=>$lastBlock->finishBlock,
                    'bloques'=>$numberOfBlocks,
                    'blolqueInicial'=>$initialBlock->id,
                    'bloqueFinal'=>$lastBlock->id
                ];

                return response()->json($respuesta);

            }else{
                //el medico esta ocupado en ese bloque
            }
        }else{
            //la sala esta ocupada en ese horario
        }
    }
}
