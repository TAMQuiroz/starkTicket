<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    protected $table = 'slots';

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function presentation(){
        return $this->belongsToMany('App\Models\Presentation','slot_presentation')->withPivot('status');
    }
}