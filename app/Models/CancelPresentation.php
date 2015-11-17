<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelPresentation extends Model
{
    protected $table = 'cancel_presentation';

    public function presentation()
    {
        return $this->belongsTo('App\Models\Presentation','presentation_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function modules()
    {
        return $this->belongsToMany('App\Models\Module','module_presentation_authorized','cancelled_presentation_id');
    }
}
