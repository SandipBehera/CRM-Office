@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user"></i>
                    </div>
                    <div>All Employee List

                    </div>
                </div>

             </div>
        </div>
        <div class="alert alert-success" id="success-alert" style="display:none"> Successfully active property</div>
        <div class="alert alert-success" id="success-alert-feature" style="display:none">Property Added to feature properties list</div>
              <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">All Leads
                            <div class="pull-right" style="float:right;margin-left:75%" >
                            <a href="{{url('/controlpanel/create-employee')}}" class="btn mr-2 mb-2 btn-primary" target="blank"><i class="pe-7s-plus"></i>
                                    Create Employee</a>
                            </div>
                                </div>
                        <div class="card-body">

                            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Department</th>
                                    <th>permission</th>
                                    <th>Employee ID</th>
                                    <th>status</th>
                                </tr>
                                </thead>
                                <tbody>

                                 @foreach ($allemployee as $item)
                                 @php
                                     $department=DB::table('departments')->where('id','=',$item->department)->first();
                                 @endphp
                                 <tr>
                                     <td><img src="{{asset('images/employee_image/'.$item->emp_image.'')}}" style="width: 180px;height:130px"></td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email_id}}</td>
                                    <td>{{$department->Department_name}}</td>
                                    <td></td>
                                    <td>{{$item->employee_id}}</td  >
                                    @if ($item->active!=0)
                                    <td ><p class="btn btn-primary">Active</p></td>
                                    @else
                                    <td>
                                        <p class="btn btn-danger"> In Active</p>
                                    </td>
                                    @endif
                                </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
             </div>
                </div>
    </div>


@endsection
