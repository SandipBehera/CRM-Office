<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table='leads';
    protected $fillable=[
        'name',
        'email_id',
        'phone',
        'leads_from',
        'leads_for',
        'asssigned_to',
    ];
    use HasFactory;
}
