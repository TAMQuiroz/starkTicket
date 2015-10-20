<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Function extends Model
{
    protected $table = 'functions';

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function seats(){
        return $this->belongsToMany('App\Models\Seat')->withPivot('status');
    }

}