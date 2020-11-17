@php
    use App\Models\LeadsComment;
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
                    <div>All Leads

                    </div>
                </div>

             </div>
        </div>
        <div class="alert alert-success" id="success-alert-Assign" style="display:none">Lead Assigned Sucessfully</div>
              <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">All Asigned Leads</div>
                            <div class="card-body">

                                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered" data-sort-order="desc">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>mobile</th>
                                        <th>Project Name</th>
                                        <th>status</th>
                                        <th>Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($assigned_leads as $item)
                                        @php
                                        $leads_comment=LeadsComment::where(['lead_id'=>$item->id])->get();
                                         @endphp
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" >{{$item->name}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}">{{$item->email_id}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" >{{$item->phone}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" >{{$item->leads_for}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}">{{$item->status}}</a></td>
                                        @if (!empty($leads_comment))
                                        <td>
                                            @php
                                                $j=1;
                                            @endphp
                                            @foreach ($leads_comment as $item_comment)

                                            {{$j++}}. {{$item_comment->comment}}<br>
                                            @endforeach
                                        </td>
                                        @else
                                        <td><p>No progress</p></td>
                                        @endif
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