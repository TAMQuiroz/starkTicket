<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AttendanceDetail extends Model
{

	  use SoftDeletes;
 protected $table = 'attendancedetail';
    protected $dates = ['deleted_at'];
    

  protected $fillable = ['id', 'tipo' , 'datetime', 'attendance_id'  ] ;

    

}
        