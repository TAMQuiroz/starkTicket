<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devolution extends Model
{
    use SoftDeletes;

    protected $table = 'devolutions';
    protected $dates = ['deleted_at'];

    public function administrator(){
        return $this->belongsTo('App\User','user_id');
    }

    public function ticket(){
    	return $this->belongsTo('App\Models\Ticket','ticket');
    }
}
