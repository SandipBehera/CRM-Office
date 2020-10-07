<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Models\AdminUsers;
use App\Models\Employee;
use App\Models\Leads;
class LoginController extends Controller
{
    public function login(Request $req){
        if($req->isMethod('post')){
            $data=$req->all();
            $check=Employee::where(['email_id'=>$data['email'],'password'=>$data['password']])->first();
            if($check->user_type==0){
                $req->session()->put('username', $check->name);
                $req->session()->put('Admin-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                return redirect('/admin/dashboard');
            }
            elseif($check->user_type==1){
                $req->session()->put('username', $check->name);
                $req->session()->put('Manager-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                return redirect('/crm-manager/dashboard');
            }
            elseif($check->user_type==2){
                $req->session()->put('username', $check->name);
                $req->session()->put('Employee-Role',$check->user_type);
                $req->session()->put('proflie_image',$check->emp_image);
                $req->session()->put('profile_id',$check->employee_id);
                return redirect('/crm-employee/dashboard');
            }
            else{
                return redirect('/login')->with('flash_message_error','Invalid Username or Password');
            }
        }
        return view('login.login');
    }
    public function dashboardcontroller(){

        return view('admin.dashboard.dashboard');

    }
    public function employeedashboard(Request $req){
        $Assigned_leads=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->count();
        $due_code_today=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date',date('Y-m-d'))->count();
        $over_due_calls=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','!=',date('Y-m-d'))->count();
        $dead_calls=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('status','=','Dead')->count();

        $assigned=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date',date('Y-m-d'))->get();
        $over_due=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','!=',date('Y-m-d'))->take(5)->get();


        return view('employee-portal.dashboard.dashboard')->with(compact('Assigned_leads','due_code_today','over_due_calls','dead_calls','assigned','over_due'));

    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}
