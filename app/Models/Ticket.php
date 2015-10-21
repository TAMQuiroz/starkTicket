<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function owner(){
        return $this->belongsTo('App\User');
    }

    public function event(){
    	//return $this->belongsTo('App\Event');
    	return 1;
    }

    public function seat(){
    	//return $this->belongsTo('App\Seat');
    	return 1;
    }
}
