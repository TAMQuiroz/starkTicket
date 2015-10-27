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
    	return $this->belongsTo('App\Models\Event');
    }

    public function seat(){
    	return $this->belongsTo('App\Models\Slot');
    }

    public function presentation(){
        return $this->belongsTo('App\Models\Presentation');
    }
}
