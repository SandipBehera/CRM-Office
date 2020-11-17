<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUsers;
use DB;
use App\Models\Employee;
use App\Models\Leads;
use App\Models\Properties;
use App\Models\LeadTransfer;
use App\Models\Attendence;
use FacebookAds\Object\Lead;

class LoginController extends Controller
{
    public function login(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
            $check=Employee::where(['email_id'=>$data['email'],'password'=>$data['password']])->first();
            $attendence_table=Attendence::where('emp_id','=',$check->employee_id)->where('created_at','=',date('Y-m-d'))->count();
            if($check){
                if($attendence_table<0){
                $attend=new Attendence();
                 $attend->emp_id=$check->employee_id;
                 $attend->save();
                }
            if($check->user_type==0){
                $req->session()->put('username', $check->name);
                $req->session()->put('Admin-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                return redirect('/admin/dashboard');
            }
            elseif($check->user_type==1){
                $department_name=DB::table('departments')->where('id','=',$check->department)->first();
                $req->session()->put('username', $check->name);
                $req->session()->put('Manager-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                $req->session()->put('department_id',$check->department);
                $req->session()->put('department',$department_name->Department_name);
                return redirect('/crm-manager/dashboard');
            }
            elseif($check->user_type==2){
                $req->session()->put('username', $check->name);
                $req->session()->put('Employee-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                $req->session()->put('permission',$check->permission);

                if($check->active==0){
                    return redirect('/login/password-change/'.$check->employee_id.'');
                }
                else{
                return redirect('/crm-employee/dashboard');
                }
            }
        }
            else{
                return redirect('/')->with('flash_message_error','Invalid Username or Password');
            }
        }
        return view('login.login');
    }
    public function dashboardcontroller(){

        $allleads=Leads::count();
        $allproperties=Properties::count();

        return view('admin.dashboard.dashboard')->with(compact('allleads','allproperties'));

    }
    public function employeedashboard(Request $req){

        $Assigned_leads=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->count();
        $due_code_today=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date',date('Y-m-d'))->count();
        $over_due_calls=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->count();
        $dead_calls=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('status','=','Dead')->count();
        $assigned=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date',date('Y-m-d'))->get();
        $over_due=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->take(5)->get();
        $site_visit_data=LeadTransfer::where('lead_to','=',session()->get('profile_id'))->get();
        return view('employee-portal.dashboard.dashboard')->with(compact('Assigned_leads','due_code_today','over_due_calls','dead_calls','assigned','over_due','site_visit_data'));


    }

    public function managerdashboard(Request $req){
        $Assigned_leads=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->get();
        $active_leads=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->where(['status'=>'Inprocess','status'=>'Follow up'])->get();
        $due_code_today=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->where('assigned_date',date('Y-m-d'))->get();
        $over_due_calls=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->get();
        $dead_calls=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->where('status','=','Dead')->get();
        $closed_calls=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->where('status','=','Closed')->get();;
        $employee_from_department=Employee::where('department','=',$req->session()->get('department_id'))->get();

        return view('manager-portal.dashboard')->with(compact('Assigned_leads','due_code_today','over_due_calls','dead_calls','active_leads','closed_calls','employee_from_department'));

    }
    public function passwordchange(Request $reqs,$id){
        if($reqs->isMethod('post')){
        $data=$reqs->all();
        $password=$data['npassword'];
        $change_password=Employee::where('employee_id','=',$id)->update(['password'=>$password,'active'=>1]);

        return redirect('/crm-employee/dashboard');
    }
        return view('login.change_pass');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
