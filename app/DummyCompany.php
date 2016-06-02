<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DummyCompany extends Model
{
  protected $connection = 'dummy';

  protected $table = 'companies';
}
