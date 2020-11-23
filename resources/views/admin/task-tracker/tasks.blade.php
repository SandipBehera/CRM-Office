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
                    <div>Task Scheduler

                    </div>
                </div>

             </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header">Create New Task</div>
                </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                         <!--Create New Task -->
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
<h5 class="card-title">Task Scheduler</h5>
 <form class="" method="post" action="#" enctype="multipart/form-data">
     {{ csrf_field() }}
     <div class="form-row">
         <div class="col-md-4">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Assign Employee Name</label>
                 <select name="empname" class=" form-control" >
                     <option value="KeyonPlus">Keyon Plus</option>
                 </select>
             </div>
         </div>
         <div class="col-md-4">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Department Name</label>
                 <select name="deptnamme" class=" form-control" id='task_dept_name'>
                     <option value="KeyonPlus">Keyon Plus</option>
                     <option value="KeyonInterio">Keyon Interio</option>
                     <option value="KeyonProperties">Keyon Properties</option>
                 </select>
             </div>
         </div>
         <div class="col-md-4" id="properties">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Propety Name</label>

             </div>
         </div>

         <div class="col-md-4">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Task Status</label>
                 <select name="tstatus" class=" form-control" id='task_status'>
                     <option value="">Select Task Status</option>
                     <option value="new">New Task</option>
                     <option value="Inprocess">Task Inprocess</option>
                     <option value="follow up">Task InReview</option>
                     <option value="site visit Initate">Task Review Done</option>
                     <option value="site visit Done">Task Done</option>
                 </select>
             </div>
         </div>
         <div class="col-md-4">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Task Deadline</label>
                 <div class='input-group date' id='datetimepicker1'>
                     <input type='text' class="form-control" name="tdeadline"/>
                     <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                     </span>
                  </div>
             </div>
         </div>
         <div class="col-md-4">
             <div class="position-relative form-group">
                 <label for="exampleEmail11" class="">Task Description</label>
                 <input name="tdesc" id="exampleEmail11"  type="text"  class="form-control">
             </div>
         </div>

     </div>
     <div class="from-row">
         <div class="col-md-12">
             <div class="center-align" style="padding-left: 40%;padding-right:40%">
                 <input type="submit" class="btn btn-primary" name="submit" value="Save">
                 <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
                 </div>
         </div>
     </div>
 </form>
                        </div>
                    </div>
         </div>
    </div>
        <div class="alert alert-success" id="success-alert-Assign" style="display:none">Task Assigned Sucessfully</div>
              <div class="row">

                    <div class="col-md-12">
                        <div class="card-header-tab card-header-tab-animation card-header">
                            <div class="card-header">Task</div>

                            <div class="d-inline-block dropdown">

                                <!--Task Status list-->
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
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <ul class="tabs-animated-shadow nav-justified tabs-animated nav">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" id="tab-c1-0" data-toggle="tab" href="#tab-animated1-0">
                                            <span class="nav-text">Today Assign Task()</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" id="tab-c1-1" data-toggle="tab" href="#tab-animated1-1">
                                            <span class="nav-text">All Tasks List()</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-animated1-0" role="tabpanel">
                                        <table style="width: 100%;" class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Task Name</th>
                                                <th>Project Name</th>
                                                <th>Assign To</th>
                                                <th>Task Assign Date-Time</th>
                                                <th>Status</th>
                                                <th>Task Complete Date-Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab-animated1-1" role="tabpanel">
                                        <table style="width: 100%;" class="mb-0 table">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Task Name</th>
                                                <th>Project Name</th>
                                                <th>Assign To</th>
                                                <th>Task Assign Date-Time</th>
                                                <th>Status</th>
                                                <th>Task Complete Date-Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp

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
    <script>
        $(function () {
          $('#datetimepicker1').datetimepicker();
       });
      </script>
@endsection
