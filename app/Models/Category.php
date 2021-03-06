<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    protected $table = 'categories';
   use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function events() {
        return $this->hasMany('App\Models\Event');
    }
    public function subcategories(){
        return $this->hasMany('App\Models\Category');
    }

    public function parentCategory(){
        return $this->belongsTo('App\Models\Category', 'father_id');
    }    
}