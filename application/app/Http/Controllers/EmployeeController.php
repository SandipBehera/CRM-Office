<?php

namespace App\Http\Controllers;
use DB;
use Image;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function CreateEmployee(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $employee=new Employee();
            $employee->name=$data['empname'];
            $employee->employee_id=$data['empid'];
            $employee->designation=$data['empdesg'];
            $employee->email_id=$data['empemail'];
            $employee->password=$data['emppass'];
            $employee->contact_no=$data['empcontact'];
            $employee->department=implode(",",$data['department']);
            $fimage=$request->file('employeeimage');
            //employee Image
            $extension = $fimage->getClientOriginalExtension();
            $fileName = rand(111,99999).'.'.$extension;
            $large_image_path = 'images/employee_image/'.$fileName;
            Image::make($fimage)->save($large_image_path);
            $employee->emp_image=$fileName;
            $employee->save();
            return redirect()->back()->with('flash_message_success','Employee Created successfullly!');
        }
        $department=DB::table('departments')->get();
        return view('admin.employees.create_employee')->with(compact('department'));
    }
    public function ViewEmployee(Request $req){
        $allemployee=Employee::get();
        return view('admin.employees.all_employee')->with(compact('allemployee'));
    }
}
