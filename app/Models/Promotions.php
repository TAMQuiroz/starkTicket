<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;




class Promotions extends Model
{
         
	use SoftDeletes;
    protected $table = 'promotions';
    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'name', 'startday', 'endday', 'description', 'desc', 'event_id'];

}
