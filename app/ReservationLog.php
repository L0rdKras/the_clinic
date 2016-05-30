<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationLog extends Model
{
  protected $table = 'reservationLogs';

  protected $fillable = ['commit','previus_status','new_status','user_id','reservation_id'];

}
