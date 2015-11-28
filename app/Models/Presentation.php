<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    protected $table = 'presentations';
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function event(){
        return $this->belongsTo('App\Models\Event');
    }

    public function slots(){
        return $this->belongsToMany('App\Models\Slot','slot_presentation')->withPivot('status');
    }

    public function zones(){
        return $this->belongsToMany('App\Models\Zone','zone_presentation')->withPivot('slots_availables');
    }

    public function getStartsAt(){
        return date('d/m/Y h:i:s a',$this->starts_at);
    }

    public function setStartsAt($unixTime){
        $this->starts_at = strtotime($unixTime);
    }
}