<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];

    public function organization(){
        return $this->belongsTo('App\organizer');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function place(){
        return $this->belongsTo('App\Models\Locals');
    }

    public function zones(){
        return $this->hasMany('App\Models\Zone');
    }

    public function functions(){
        return $this->hasMany('App\Models\Function');
    }
}