<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DummyPatient extends Model
{
    //
    protected $connection = 'dummy';

    protected $table = 'patients';
}
