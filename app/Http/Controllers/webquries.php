<?php

namespace App\Http\Controllers;

use App\Models\WebsiteQuries;
use Illuminate\Http\Request;

class webquries extends Controller
{
    public function index(Request $req){
        $fetch_quires=WebsiteQuries::all();
        return view('admin.lead.website_leads')->with(compact('fetch_quires'));
    }
}
