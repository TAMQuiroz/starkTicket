<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    protected $table = 'presentations';

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function slots(){
        return $this->belongsToMany('App\Models\Slot')->withPivot('status');
    }

}