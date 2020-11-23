@php
    use App\Models\LeadsComment;
    use App\Models\Employee;
    $date=date_default_timezone_set('Asia/Kolkata');
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
                                            <span class="nav-text">Today Assign Lead({{$today_assign_employee_list->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1">
                                            <span class="nav-text">All Assigned Lead({{$Assigned_leads->count()}})</span>
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
                                                @foreach ($today_assign_employee_list as $item)
                                                @php

                                                $employee_name=Employee::where('employee_id','=',$item->asssigned_to)->first();
                                                $comments=LeadsComment::where('lead_id','=',$item->id)->get();

                                                @endphp

                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$item->name}}</a></td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$item->leads_for}}</a></td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$employee_name->name}}</a></td>
                                                @if ($item->status=='NEW' && $item->status!=date('Y-m-d'))
                                                <td class="text-center btn-danger"><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Over Due</a></td>
                                                @elseif ($item->status=='follow up')
                                                <td class="text-center btn-warning" ><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Follow Up</a></td>
                                                @elseif ($item->status=='site visit Initate')
                                                <td class="text-center bg-malibu-beach" ><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Site Visit Initate</a></td>
                                                @elseif ($item->status=='site visit Done')
                                                <td class="text-center bg-ripe-malin" ><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @elseif ($item->status=='closed')
                                                 <td class="text-center bg-grow-early" ><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @elseif ($item->status=='dead')
                                                <td class="text-center btn-gradient-focus" ><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @else
                                                <td class="text-center btn-gradient-secondary"><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color: #fff;font-weight:500">{{$item->status}}</a></td>
                                                @endif
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
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered" data-sort-order="desc">
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
                                                @foreach ($Assigned_leads as $item_follow_up)
                                                @php

                                                $employee_name=Employee::where('employee_id','=',$item_follow_up->asssigned_to)->first();
                                                $comments=LeadsComment::where('lead_id','=',$item_follow_up->id)->get();

                                                @endphp

                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$item_follow_up->name}}</a></td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$item_follow_up->leads_for}}</a></td>
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$employee_name->name}}</a></td>
                                                @if ($item_follow_up->status=='NEW' && $item_follow_up->status!=date('Y-m-d'))
                                                 <td class="text-center btn-danger"><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Over Due</a></td>
                                                @elseif ($item_follow_up->status=='follow up')
                                                <td class="text-center btn-warning" ><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Follow Up</a></td>
                                                @elseif ($item_follow_up->status=='site visit Initate')
                                                <td class="text-center bg-malibu-beach" ><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Site Visit Initate</a></td>
                                                @elseif ($item_follow_up->status=='site visit Done')
                                                <td class="text-center bg-ripe-malin" ><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @elseif ($item_follow_up->status=='closed')
                                                <td class="text-center bg-grow-early" ><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @elseif ($item_follow_up->status=='dead')
                                                <td class="text-center btn-gradient-focus" ><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">Site Visit Done</a></td>
                                                @else
                                                    <td class="text-center btn-gradient-secondary"><a href="javascript:void(0)" id="Add_to_db_{{$item_follow_up->id}}" style="color: #fff;font-weight:500">{{$item_follow_up->status}}</a></td>
                                                @endif
                                                <td><a href="javascript:void(0)" id="Add_to_db_" >{{$item_follow_up->assigned_date}}</a></td>

                                                <td>
                                                    @if(!empty($comments))
                                                    @php
                                                        $j=1;
                                                    @endphp
                                                    @foreach ($comments as $item_follow_up_comments)
                                                    {{$j++}}. {{$item_follow_up_comments->comment}}
                                                    updated date:{{$item_follow_up->created_at}}
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
