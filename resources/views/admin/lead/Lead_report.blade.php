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
                    <div>Generate Leads Report

                    </div>
                </div>

             </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger fade show">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong style="color: red">{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                     @if(Session::has('flash_message_success'))
                        <div class="alert alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                    <h5 class="card-title">Leads Report</h5>

                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Department Name</label>
                                        <select name="dept_name" class=" form-control" id='dept_name' >
                                            <option value="0">All Department</option>
                                            @foreach ($department as $item)
                                            <option value="{{$item->id}}">{{$item->Department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="select_prop">
                                    <label for="exampleEmail11" class="">Proeprty Name</label>
                                    <select name="dept_name" class=" form-control" id="prop_name">
                                        <option>Select Property</option>
                                        <option value="0">All Project</option>
                                        @foreach ($properties as $item_prop)
                                        <option value="{{$item_prop->property_name}}">{{$item_prop->property_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee Name</label>
                                        <select name="emp_name" class=" form-control" id='emp_name'>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Duration</label>
                                        <select name="lead_duration" class=" form-control" id="lead_duration">
                                            <option value="1">Today</option>
                                            <option value="2">Last 3 Days</option>
                                            <option value="3">This Week</option>
                                            <option value="4">This Month</option>
                                            <option value="5">Custom</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Status</label>
                                        <select name="lead_status" class=" form-control" id="lead_status">
                                            <option value="new">New</option>
                                            <option value="Inprocess">InProcess</option>
                                            <option value="follow up">Folllow Ups</option>
                                            <option value="site visit Initate">Site Visit Initiate</option>
                                            <option value="site visit Done">Site Visit Done</option>
                                            <option value="closed">Closed</option>
                                            <option value="dead">Dead</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="lead_from_date" >
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead From Date</label>
                                        <input type="text" name="from_date" class="form-control" data-toggle="datepicker" id="from_date">
                                    </div>
                                </div>
                                <div class="col-md-4" id="lead_to_date">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Lead To Date</label>
                                    <input type="text" class="form-control" name="to_date" data-toggle="datepicker" autocomplete="off" id="to_date">
                                    </div>
                                </div>
                            </div>
                            <div class="from-row">
                                <div class="col-md-12">
                                    <div class="center-align" style="padding-left: 40%;padding-right:40%">
                                        <input type="submit" class="btn btn-primary" name="submit" id="submit_data" value="Generate">
                                        <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
                                        </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!--post lead reports data-->
    <script>
        $('#submit_data').click(function(){
            var department=$('#dept_name').val();
            var property_name=$('#prop_name').val();
            var duration=$('#lead_duration').val();
            var from_date=$('#from_date').val();
            var to_date=$('#to_date').val();
            var status=$('#lead_status').val();
            var flag=true;
            /**** validation end here ***/
            /* if all values are fine then start posting the values into the backend file*/
            if(flag){
                $.ajax({
                    type:'post',

                    url:'/lead-report',
                    dataType:'json',
                    data:{
                        "_token":"{{csrf_token()}}",
                          "department":department,
                          "property_name":property_name,
                          "status":status,
                          "duration":duration,
                          "from_date":from_date,
                          "to_date":to_date,
                    },
                    success:function(result){

                    }
                });
            }
        });
        </script>
@endsection
