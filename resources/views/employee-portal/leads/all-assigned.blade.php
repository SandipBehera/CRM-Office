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
                                        <th>Project Name</th>
                                        <th>Assigned Date</th>
                                        <th>status</th>

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
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color:black;font-weight:500">{{$item->name}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color:black;font-weight:500">{{$item->leads_for}}</a></td>
                                        <td><a href="javascript:void(0)" id="Add_to_db_{{$item->id}}" style="color:black;font-weight:500">{{$item->assigned_date}}</a></td>
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
