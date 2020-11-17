<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table='properties';
    use HasFactory;
    function propertydetails(){
        return $this->hasMany('App\Models\Properties_details');
    }
    function propertyimage(){
        return $this->hasMany('App\Models\Property_image');
    }
}
