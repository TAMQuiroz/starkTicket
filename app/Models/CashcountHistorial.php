<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashcountHistorial extends Model
{
	use SoftDeletes;
    
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['module_id', 'salesman_id', 'initial_cash', 'sales_cash', 'devolutions_cash', 'total_cash','dateCashCount'];
}
