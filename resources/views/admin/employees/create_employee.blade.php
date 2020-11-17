@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-add-user"></i>
                    </div>
                    <div>Add New Employees

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
                        <h5 class="card-title">Add Employee Information</h5>
                        <form class="" method="post" action="{{url('/admin/create-employee')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee Name</label>
                                        <input name="empname" id="exampleEmail11" placeholder="Employee Name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee ID</label>
                                        <input name="empid" id="exampleEmail11" placeholder="Employee id" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee Designation</label>

                                        <select name='empdesg' class="form-control">
                                        <option value="">Select Designation</option>
                                        @foreach ($designation as $item_designation)
                                        <option value="{{$item_designation->id}}">{{$item_designation->designation_name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee EmailID</label>
                                        <input name="empemail" id="exampleEmail11" placeholder="Employee EmailID" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee Password</label>
                                        <input name="emppass" id="exampleEmail11" placeholder="Employee Password" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Employee Contactno</label>
                                        <input name="empcontact" id="exampleEmail11" placeholder="Employee Contactno" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Department</label>
                                            <select multiple="multiple" name="department[]" class="multiselect-dropdown form-control">
                                                <optgroup label="Departments">
                                                    @foreach ($department as $item)
                                                    <option value="{{$item->id}}">{{$item->Department_name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                    </div>
                                </div>

                            </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Employee Permission</h5>
                            <div class="from-row">
                                <div class="col-md-6">
                                    <label for="exampleEmail11" class="">
                                    <input type="checkbox" name="task[]" value="Calling">Tele Calling
                                    <input type="checkbox" name="task[]" value="Site Visit"> Site Visit
                                    <input type="checkbox" name="task[]" value="Report Generation">Report Generation
                                    <input type="checkbox" name="task[]" value="Add Property">Add Property
                                </label>

                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="from-row">
                                <div class="col-md-4">
                                    <label for="exampleEmail11" class="">Employee Image</label>
                                    <input type="file" name="employeeimage" id="employee-gallery-photo-add">
                                    <div class="employee-gallery" style="padding-top:3%;width:100%"></div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="from-row">
                                <div class="col-md-12">
                                    <div class="center-align" style="padding-left: 40%;padding-right:40%">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Create">
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
