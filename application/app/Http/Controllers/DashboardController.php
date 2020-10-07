<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leads;

class DashboardController extends Controller
{
    public function leadsBoard(Request $reqs){
        $Alldata=Leads::all();
        $Datacount=Leads::count();
        return view('admin.layouts.admin_design')->with(compact('Alldata','Datacount'));
    }
}
