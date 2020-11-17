<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties_details extends Model
{
    protected $table='property_details';
    use HasFactory;
    function property(){
        return $this->belongsTo('App\Models\Properties');
    }
}
