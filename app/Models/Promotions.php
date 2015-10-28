<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;




class Promotions extends Model
{
         
	use SoftDeletes;
    protected $table = 'promotions';
    protected $dates = ['deleted_at'];

    //  protected $fillable = ['id', 'name', 'startday', 'endday', 'description',  'event_id','user_id', 'typePromotion','desc', 'access_id' , 'zone_id','carry','pay' ] ;




  public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }

public function user(){
        return $this->belongsTo('App\User','user_id');
    }

public function access(){
        return $this->belongsTo('App\Models\accessPromotion','access_id');
    }


public function zone(){
        return $this->belongsTo('App\Models\Zone','zone_id');
    }



}
