<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class TaskScheudler extends Controller
{
    public function index(Request $req){
        $employee_name=Employee::where('designation','DigitalMarketer')->get();
        return view('admin/task-tracker/tasks')->with(compact('employee_name'));
    }
}
