<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='emplyoee';
    use HasFactory;
    public function leads(){
        return $this->belongsToMany('App\Models\Leads');
    }
}
