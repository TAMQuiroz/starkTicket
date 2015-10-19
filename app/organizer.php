<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class organizer extends Model
{

   	use SoftDeletes;

	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['organizerName', 'organizerLastName', 'businessName', 'ruc', 'countNumber', 'telephone','dni', 'email', 'address'];
}
      