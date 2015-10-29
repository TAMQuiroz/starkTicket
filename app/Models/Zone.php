<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    protected $table = 'zones';

    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function slots(){
        return $this->hasMany('App\Models\Slot');
    }

    public function presentation(){
        return $this->belongsToMany('App\Models\Presentation','zone_presentation')->withPivot('slots_availables');
    }
}