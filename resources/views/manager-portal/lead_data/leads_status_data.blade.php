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
                    <div>{{Session::get('lead_status')}} Leads

                    </div>
                </div>

             </div>
        </div>

              <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0">
                                            <span class="nav-text">This Week</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1">
                                            <span class="nav-text">Last Week</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1">
                                            <span class="nav-text">customs</span>
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
                                                <th>Update Dates</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($fetch_lead_details as $item)
                                                @php

                                                $employee_name=Employee::where('employee_id','=',$item->asssigned_to)->first();
                                                $comments=LeadsComment::where('lead_id','=',$item->id)->where('lead_status','=',Session::get('lead_status'))->get();

                                                @endphp

                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->leads_for}}</td>
                                                <td>{{$employee_name->name}}</td>
                                                <td>

                                                <p><b>Asssigned Date:</b>{{$item->assigned_date}}</p>
                                                    @if(!empty($comments))
                                                    @foreach ($comments as $item_comments)
                                                     <p><b>Last Updated Date&time: </b>{{$item_comments->created_at}}</p>
                                                     <p><b>Next Chessing Date:</b>{{$item_comments->followup_date}}</p>
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
                                </div>
                            </div>
                            </div>
                        </div>
                 </div>
            </div>

        <!-- Large modal -->
@endsection
