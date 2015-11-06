<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'payments';
    protected $dates = ['deleted_at'];

    public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }

    public function promoter(){
        return $this->belongsTo('App\User','promoter_id');
    }
}