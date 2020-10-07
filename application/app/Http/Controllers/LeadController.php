<?php

namespace App\Http\Controllers;

use App\Models\Leads;
use App\Models\LeadActivate;
use Illuminate\Http\Request;
use App\Http\Controllers\LeadController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadImport;
use Ixudra\Curl\Facades\Curl;
use Facebook\Facebook;
use FacebookAds\Object\Lead;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\Page;
use FacebookAds\Object\Ad;
class LeadController extends Controller
{
public function index(){
        $Alldata=Leads::all();

return view('admin.lead.all_lead')->with(compact('Alldata'));
}
public function uploadleads(Request $request){
    if($request->isMethod('post')){
    Excel::import(new LeadImport,$request->file('fupload')->store('temp'));
    return redirect('/admin/leads');
    }
    return view('admin.lead.upload_leads');
    }
public function leadsstatus()
    {
        $Alldata=Leads::all();
        $Datacount=Leads::count();
        $notasssigned=Leads::where('asssigned_to','=',null)->count();
        $lead_gen_by_date=Leads::groupBy('created_at')->count();
        return view('admin.lead.leads_status')->with(compact('Alldata','Datacount','notasssigned','lead_gen_by_date'));
    }
public function LeadAssign(Request $reqs){
    $Assigned=Leads::where(['id'=>$reqs->id])->update(['asssigned_to'=>$reqs->Employee_id,'assigned_date'=>date('Y-m-d H:i:s')]);

    return response()->json($Assigned);
}
public function acceptleads(Request $req){

}
public function LeadsAssigned(Request $req){
    $assigned_leads=Leads::where('asssigned_to',$req->session()->get('profile_id'))->get();
    return view('employee-portal.leads.all-assigned')->with(compact('assigned_leads'));
}
public function Leadstatus(Request $req,$id){
    $check_id=LeadActivate::where('lead_id',$id)->count();
    $lead=Leads::where('id',$id)->first();
    if($check_id<0){
        $data=new LeadsActivate();
        $data->emp_id=$lead->asssigned_to;
        $data->lead_id=$id;
        $data->status=$lead->status;
        $data->save();
        return view('employee-portal.leads.leads-data');
    }
    }

}
