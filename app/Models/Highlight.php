<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Highlight extends Model
{
    use SoftDeletes;
    protected $table = 'highlightedevents';
    protected $dates = ['deleted_at'];

    public function event(){
    	return $this->belongsTo('App\Models\Event');
    }
}