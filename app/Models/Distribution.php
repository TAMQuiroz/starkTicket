<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $table = 'distribution';

    public function local(){
        return $this->belongsTo('App\Models\Local');
    }
}
