<?php

namespace App;





use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
	
	


class politics extends Model 
{



     protected $table = 'politics';


    protected $dates = ['deleted_at'];

    protected $fillable = ['id','name', 'description','state'];



}
