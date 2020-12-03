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
                                                @foreach ($fetch_lead_details as $item)
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

                            </div>
                        </div>
                 </div>
            </div>

        <!-- Large modal -->
@endsection
