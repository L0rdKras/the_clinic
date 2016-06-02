<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Reservation;
use App\ReservationLog;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function dataReservation($id){
        $reservation = Reservation::find($id);

        $room   = 1;

        $start  = "";

        $finish = "";

        foreach ($reservation->ReservationsInfo as $info) {
            $room = $info->room;

            if($start == ""){
                $start = $info->Block->startBlock;
            }

            $finish = $info->Block->finishBlock;
        }

        $arrayRespuesta = [
            "patient"   => $reservation->Patient->firstname." ".$reservation->Patient->lastname,
            "company"   => $reservation->Patient->Company->name,
            "medic"     => $reservation->Medic->name,
            "atention"  => $reservation->Atention->name,
            "status"    => $reservation->status,
            "comment"   => $reservation->comment,
            "room"      => $room,
            "start"     => $start,
            "finish"    => $finish,
            "date"      => $reservation->reservationDate
        ];

        return response()->json($arrayRespuesta);
    }

    public function updateStatus(Request $request, $id)
    {
        $user = $request->user();

        //return $user;

        $reservation = Reservation::find($id);

        $prev_status = $reservation->status;

        $respuesta = $request->only(['newStatus','commit']);

        $data_log = [
          'commit' => $respuesta['commit'],
          'previus_status' => $reservation->status,
          'new_status' => $respuesta['newStatus'],
          'user_id' => $user->id,
          'reservation_id' => $reservation->id
        ];

        $log = new ReservationLog($data_log);

        $log->save();

        $reservation->status = $respuesta['newStatus'];

        $reservation->save();

        return response()->json(["respuesta"=>"Actualizado","id"=>$reservation->id,"status"=>$respuesta['newStatus']]);
    }
}
