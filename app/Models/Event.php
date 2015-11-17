<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $dates = ['deleted_at'];

    public function organization(){
        return $this->belongsTo('App\Models\Organizer','organizer_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function place(){
        return $this->belongsTo('App\Models\Local','local_id');
    }

    public function zones(){
        return $this->hasMany('App\Models\Zone');
    }

    public function presentations(){
        return $this->hasMany('App\Models\Presentation')->where("cancelled","0");
    }

    public function highlights() {
        return $this->hasMany('App\Models\Highlight');
    }
    public function numberTickets() {
        return $this->hasMany('App\Models\Ticket')->where(['event_id'=>$this->id,'cancelled'=>'0'])->sum('quantity');
    }
    public function amountAccumulated() {
        return $this->hasMany('App\Models\Ticket')->where(['event_id'=>$this->id,'cancelled'=>'0'])->sum('total_price');
    }
}