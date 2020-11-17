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
                        <form class="" method="post" action="{{url('/crm-employee/status-update-leads/')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Department Name</label>
                                        <select name="dept_name" class=" form-control" id='dept_name'>
                                            <option value="">Select Department</option>
                                            @foreach ($department as $item)
                                            <option value="{{$item->id}}">{{$item->Department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                <div class="col-md-4" id="lead_from_date" >
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead From Date</label>
                                        <input type="text" name="from_date" class="form-control" data-toggle="datepicker">
                                    </div>
                                </div>
                                <div class="col-md-4" id="lead_to_date">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Lead To Date</label>
                                    <input type="text" class="form-control" name="to_date" data-toggle="datepicker" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="from-row">
                                <div class="col-md-12">
                                    <div class="center-align" style="padding-left: 40%;padding-right:40%">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Generate">
                                        <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
