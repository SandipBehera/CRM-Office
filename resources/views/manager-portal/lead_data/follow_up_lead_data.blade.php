@php
    use App\Models\LeadsComment;
    use App\Models\Employee;
@endphp
@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-news-paper"></i>
                    </div>
                    <div>Today Leads

                    </div>
                </div>

             </div>
        </div>
        <div class="alert alert-success" id="success-alert-Assign" style="display:none">Lead Assigned Sucessfully</div>
              <div class="row">

                    <div class="col-md-12">
                        <div class="card-header-tab card-header-tab-animation card-header">
                            <div class="card-header">Today Leads</div>
                            <div class="btn-actions-pane-right text-capitalize">
                            <div class="d-inline-block dropdown">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="pe-7s-edit"></i>
                                    </span>
                                    Filters
                                </button>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0)" id="new_assign">
                                                <i class="nav-link-icon lnr-inbox"></i>
                                                <span>New Assigned</span>
                                            <div class="ml-auto badge badge-pill badge-secondary"></div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="javascript:void(0)" id="today_follow_ups">
                                                <i class="nav-link-icon lnr-book"></i>
                                                <span>Today Follow-Ups</span>
                                                <div class="ml-auto badge badge-pill badge-danger">5</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0">
                                            <span class="nav-text">Today follow-up Lead({{$today_followup_employee_list->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1">
                                            <span class="nav-text">All follow-up Lead({{$all_follow_up_leads->count()}})</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">
                                        <table style="width: 100%;" class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Lead Name</th>
                                                <th>Project Name</th>
                                                <th>Assign To</th>
                                                <th>Status</th>
                                                <th>Comment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($today_followup_employee_list as $item)
                                                @php

                                                $employee_name=Employee::where('employee_id','=',$item->asssigned_to)->first();
                                                $comments=LeadsComment::where('lead_id','=',$item->id)->get();

                                                @endphp

                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->leads_for}}</td>
                                                <td>{{$employee_name->name}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>
                                                    @if(!empty($comments))
                                                    @php
                                                        $j=1;
                                                    @endphp
                                                    @foreach ($comments as $item_comments)
                                                    {{$j++}}. {{$item_comments->comment}}
                                                    @endforeach
                                                    @else
                                                    Did Not speak
                                                    @endif
                                                </td>
                                                </tr>
                                                <script>
                                                    $(document).on('click','#Add_to_db_{{$item->id}}',function(){
                                                        var lead_id="{{$item->id}}";

                                                        $.ajax({

                                                            type:"post",
                                                            url:"/today-picked-up",
                                                            data:{
                                                                "_token":"{{csrf_token()}}",
                                                                "lead_id":lead_id,
                                                                'emp_id':"{{Session::get('profile_id')}}",
                                                                'status':"{{$item->status}}"
                                                            },
                                                            success:function(res){
                                                                if(res){
                                                                    window.location.href="/crm-employee/status-update-leads/{{$item->id}}";
                                                                }
                                                            }

                                                        });
                                                    });
                                                </script>

                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
                                        <table style="width: 100%;" class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Lead Name</th>
                                                <th>Project Name</th>
                                                <th>Assign To</th>
                                                <th>Status</th>
                                                <th>Assigned Date</th>

                                                <th>Comment</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($all_follow_up_leads as $item_follow_up)
                                                @php

                                                $employee_name=Employee::where('employee_id','=',$item_follow_up->asssigned_to)->first();
                                                $comments=LeadsComment::where('lead_id','=',$item_follow_up->id)->get();

                                                @endphp

                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item_follow_up->name}}</td>
                                                <td>{{$item_follow_up->leads_for}}</td>
                                                <td>{{$employee_name->name}}</td>

                                                <td>{{$item_follow_up->status}}</td>
                                                <td>{{$item_follow_up->assigned_date}}</td>
                                                <td>
                                                    @if(!empty($comments))
                                                    @php
                                                        $j=1;
                                                    @endphp
                                                    @foreach ($comments as $item_follow_up_comments)
                                                    {{$j++}}. {{$item_follow_up_comments->comment}}
                                                    @endforeach
                                                    @else
                                                    Did Not speak
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                 </div>
            </div>
    </div>
    <!-- Large modal -->
@endsection
