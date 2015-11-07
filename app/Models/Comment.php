<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
   use SoftDeletes;
    protected $table = 'comment';
    protected $dates = ['deleted_at'];

  public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


}
