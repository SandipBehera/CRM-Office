<?php

namespace App\Http\Controllers;
use DB;
use Image;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendence;
use App\Models\Leads;

class EmployeeController extends Controller
{
    public function CreateEmployee(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $designation=DB::table('designation')->where('id','=',$data['empdesg'])->first();
            $employee=new Employee();
            $employee->name=$data['empname'];
            $employee->employee_id=$data['empid'];
            $employee->designation=$designation->designation_name;
            $employee->email_id=$data['empemail'];
            $employee->password=$data['emppass'];
            $employee->contact_no=$data['empcontact'];
            $employee->department=implode(",",$data['department']);
            $employee->permission=implode(",",$data['task']);
            $employee->user_type=$designation->role;
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
        $designation=DB::table('designation')->get();
        return view('admin.employees.create_employee')->with(compact('department','designation'));
    }
    public function ViewEmployee(Request $req){
        $allemployee=Employee::where('name','!=','Super Admin')->get();
        return view('admin.employees.all_employee')->with(compact('allemployee'));
    }

    public function employeebydepartment(Request $req){
        $emp_by_dept=Employee::where('department','=',$req->project_name)->pluck('name','employee_id');
        return response()->json($emp_by_dept);
    }
    public function employeebyproject(Request $req){
        if($req->project_name==0){
            $emp_by_project1=DB::table('emplyoee')->join('leads','emplyoee.employee_id','=','leads.asssigned_to')->groupBy('leads.asssigned_to')->pluck('emplyoee.name','emplyoee.employee_id');
        }
        else{
        $emp_by_project1=DB::table('emplyoee')->join('leads','emplyoee.employee_id','=','leads.asssigned_to')->where('leads.leads_for','LIKE','%'.$req->project_name.'%')->groupBy('leads.asssigned_to')->pluck('emplyoee.name','emplyoee.employee_id');
        }
        return response()->json($emp_by_project1);

    }
    public function attendence(Request $req){
        if($req->isMethod('post')){
        if($req->logtype=='login'){
                $login=Attendence::where('emp_id','=',$req->session()->get('profile_id'))->update(['log_in'=>date('Y-m-d')]);
               return response()->json($login);
            }
            else{
             $logout=Attendence::where('emp_id','=',$req->session()->get('profile_id'))->update(['log_out'=>date('Y-m-d')]);
                return response()->json($logout);
            }
        }
        $log_status=Attendence::where('emp_id','=',$req->session()->get('profile_id'))->first();
        return view('employee-portal.myprofile.attendence')->with(compact('log_status'));
    }
}
