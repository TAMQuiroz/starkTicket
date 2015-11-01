<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Assistance extends Model
{

	  use SoftDeletes;
 protected $table = 'assistance';

    

  protected $fillable = ['id', 'tipo' ,'datetime', 'salesman_id'  ] ;

    

}
