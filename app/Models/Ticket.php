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

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function presentation(){
        return $this->belongsTo('App\Models\Presentation');
    }

    public function salesman(){
        return $this->belongsTo('App\User');
    }

    public function promo(){
        return $this->belongsTo('App\Models\Promotions');
    }
}
