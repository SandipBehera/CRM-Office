<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class property_image extends Model
{
    protected $table='property_image';
    use HasFactory;
    function property(){
        return $this->belongsTo('App\Models\Properties');
    }
}
