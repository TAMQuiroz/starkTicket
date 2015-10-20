<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    protected $table = 'seats';

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function function(){
        return $this->belongToMany('App\Models\Function')->withPivot('status');
    }
}