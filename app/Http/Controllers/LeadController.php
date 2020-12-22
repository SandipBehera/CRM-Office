<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Leads;
use App\Models\LeadActivate;
use App\Models\LeadsComment;
use App\Models\leadbooked;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadImport;
use Ixudra\Curl\Facades\Curl;
use Facebook\Facebook;
use FacebookAds\Object\Lead;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Page;
use FacebookAds\Object\Ad;
use App\Models\LeadTransfer;
use App\Models\Properties;
use FacebookAds\Session;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    //super admin dashboard list
public function index(){
        $Alldata=Leads::all();

return view('admin.lead.all_lead')->with(compact('Alldata'));
}
//for upload all leads from excel
public function uploadleads(Request $request){
    if($request->isMethod('post')){
    Excel::import(new LeadImport,$request->file('fupload')->store('temp'));
    return redirect('/admin/leads');
    }
    return view('admin.lead.upload_leads');
    }
   //manager dashboard counts
public function leadsstatus()
    {
        $Alldata=Leads::all();
        $Datacount=Leads::count();
        $notasssigned=Leads::where('asssigned_to','=',null)->count();
        $lead_gen_by_date=Leads::groupBy('created_at')->count();
        $over_due_call=Leads::where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->count();
        $closed_call_count=Leads::where('status','=','closed')->count();
        $dead_leads_count=Leads::where('status','=','dead')->count();
        return view('admin.lead.leads_status')->with(compact('Alldata','Datacount','notasssigned','lead_gen_by_date','over_due_call','closed_call_count','dead_leads_count'));
    }
    //assign leads to employees from admin dashboard
public function LeadAssign(Request $reqs){
    $Assigned=Leads::where(['id'=>$reqs->id])->update(['asssigned_to'=>$reqs->Employee_id,'assigned_date'=>date('Y-m-d H:i:s'),'status'=>'Assigned']);

    return response()->json($Assigned);
}
//all assigned leads to employeee
public function LeadsAssigned(Request $req){
    $assigned_leads=Leads::where('asssigned_to',$req->session()->get('profile_id'))->orderBy('id','DESC')->get();
    return view('employee-portal.leads.all-assigned')->with(compact('assigned_leads'));
}
//redirect to lead-status-update page
public function leadstatusget(Request $req,$id){
    $lead_details=Leads::where('id',$id)->first();
    $leads_comments=LeadsComment::where('lead_id',$id)->get();
    $leads_comments_count=LeadsComment::where('lead_id',$id)->count();
    $site_visit_employee_all=Employee::where('permission','like','%Site Visit%')->get();
    $property_list=Properties::where('active','=','1')->get();
    return view('employee-portal.leads.leads-data')->with(compact('lead_details','leads_comments','leads_comments_count','site_visit_employee_all','property_list'));
}
//employee data recoreder update
public function Leadstatus(Request $req,$id){

        $data=$req->all();
        $leads_comment=new LeadsComment();
        $leads_comment->lead_id=$id;
        $leads_comment->lead_status=$data['status'];
        $leads_comment->followup_date=date($data['nxd']);
        //$leads_comment->follow_up_time='';
        if($data['status']!='closed'){
        $leads_comment->comment=$data['comments'];
        }
        else{
            $leads_comment->comment='Property Have Been closed in:'.$data['booked_porp_name'].'By:'.session()->get('username');
        }
        $leads_comment->location='';
        $leads_comment->save();
        if($data['status']=='site visit Initate'){
            $leads_transfer=new LeadTransfer();
            $leads_transfer->lead_id=$id;
            $leads_transfer->lead_from=session()->get('profile_id');
            $leads_transfer->lead_to=$data['visit_assign'];
            $leads_transfer->save();
        }
        elseif($data['status']=='closed'){
            $booked_img=$data['booking_form_img'];
            foreach($booked_img as $fimage){
            $lead_booked=new leadbooked();
            $lead_booked->lead_id=$id;
            $lead_booked->bregd_name=$data['client_name'];
            $lead_booked->bprop_name=$data['booked_porp_name'];
            $lead_booked->bunit=$data['booking_unit'];
            //booking form images
                $extension = $fimage->getClientOriginalExtension();
                $fileName = rand(111,99999).'.'.$extension;
                $large_image_path = 'images/Booking_images/'.$fileName;
                Image::make($fimage)->save($large_image_path);
                $lead_booked->form_img =$fileName;
                $lead_booked->save();

        }
        Leads::where('id',$id)->update(['status'=>$data['status']]);
        return response()->json();
    }
    }
    //overdue leads list
    public function overduepick(Request $req){
        $overdue_leads=Leads::where('asssigned_to',$req->session()->get('profile_id'))->where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->get();
        return view('employee-portal.leads.overdue-leads')->with(compact('overdue_leads'));
    }
    //followup leads fetching from database
    public function followupleads(Request $req){
        $follow_up_leads=Leads::where('asssigned_to',$req->session()->get('profile_id'))->where(['status'=>'Follow up'])->get();
    }
    //if overdue-lead picked by the employee
    public function overduepicked(Request $reqed){
        $data=new LeadActivate();
        $data->emp_id=$reqed->emp_id;
        $data->lead_id=$reqed->lead_id;
        $data->status=$reqed->status;
        $data->created_at=date('Y-m-d');
        Session()->put('project_name',$reqed->project_name);
        $data->save();
        if($reqed->status=='New' ||$reqed->status=='Assigned' ){
            Leads::where(['id'=>$reqed->lead_id])->update(['status'=>'pickedup']);
        }
        return response()->json();
    }
    //if today-leads picked by the employee
    public function todaypicked(Request $reqed){
        $data=new LeadActivate();
        $data->emp_id=$reqed->emp_id;
        $data->lead_id=$reqed->lead_id;
        $data->status=$reqed->status;
        $data->created_at=date('Y-m-d');
        $data->save();
            Session()->put('project_name',$reqed->project_name);
        if($reqed->status=='New' ||$reqed->status=='Assigned' ){
        Leads::where(['id'=>$reqed->lead_id])->update(['status'=>'pickedup']);
        }
        return response()->json();
    }
    //Lead Filter
    public function lead_filter(Request $req){

    }
    //All today assigned leads
    public function todayassigned(Request $req){
        $check_for_today=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','=',date('Y-m-d'))->where('status','=','Assigned','or','status','=','NEW')->get();
        $check_for_today_follow_up=Leads::where(['asssigned_to'=>$req->session()->get('profile_id')])->where('assigned_date','=',date('Y-m-d'))->where('status','=','follow up')->get();

        return view('employee-portal.leads.today-leads')->with(compact('check_for_today','check_for_today_follow_up'));
    }
    //lead Report Generation
    public function leadsreport(Request $request){

        $department=DB::table('departments')->get();
        $properties=Properties::get();
        return view('admin.lead.Lead_report')->with(compact('department','properties'));
    }
    //data visulization
    //pie chart of all lead status

    //Employee assign today data list
    public function todayemployeeassign(Request $req){
        $today_assign_employee_list=Leads::where('assigned_date',date('Y-m-d'))->get();
        $Assigned_leads=Leads::where('leads_for','LIKE','%'.$req->session()->get('department').'%')->get();
        return view('manager-portal.lead_data.today_assign_lead_data')->with(compact('today_assign_employee_list','Assigned_leads'));
    }
    // Follow Up Leads Converted by telecallers
    //check the follow up leads from database
    //display in the list format of the follo-up-leads page
    public function followupleadsbyemployee(Request $req){
        $today_followup_employee_list=Leads::where('assigned_date',date('Y-m-d'))->where('status','=','Follow up')->get();
        $all_follow_up_leads=Leads::where('status','=','Follow up')->get();
        return view('manager-portal.lead_data.follow_up_lead_data')->with(compact('today_followup_employee_list','all_follow_up_leads'));
    }
    //Employee Lead Status
    //check for the required lead status(like: Inporcess leads,site visit initate,closed)
    //get the employee Id
    //show the all leads details with the respected generated date and time
    //fetch the documents images w.r.t the lead id
    public function EmployeeLeadStatus(Request $request,$status,$id){
        if($status=="closed"){
            $fetch_lead_details=Leads::where(['asssigned_to'=>$id,'status'=>$status])->get();
        }
        elseif($status=="overdue"){
            $fetch_lead_details=Leads::where(['asssigned_to'=>$id])->where('assigned_date','!=',date('Y-m-d'))->where(['status'=>'Assigned','status'=>'New'])->get();
        }
        elseif($status=="site visit Initate"){
            $fetch_lead_details=Leads::where(['asssigned_to'=>$id,'status'=>$status])->get();
        }
        elseif($status=='site visit Done'){
            $fetch_lead_details=Leads::where(['asssigned_to'=>$id,'status'=>$status])->get();
        }
        session()->put('lead_status',$status);
        return view('manager-portal.lead_data.leads_status_data')->with(compact('fetch_lead_details'));
    }
    public function ReportGenerate(Request $req){
        if(empty($req->from_date) && empty($req->to_date))
        {
            if($req->duration=='1'){
                $report=Leads::where('leads_for','LIKE','%'.$req->department.'%')->where('leads_for','LIKE','%'.$req->property_name.'%')->where(['status'=>$req->status])->get();

            }
        }
        return response()->json();
    }
}
