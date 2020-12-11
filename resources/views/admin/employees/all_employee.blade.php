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

        <div class="row">
            @foreach ($allemployee as $item)
            @php
                $department=DB::table('departments')->where('id','=',$item->department)->first();

            @endphp
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                    <div class="dropdown-menu-header">
                        <div class="dropdown-menu-header-inner bg-alternate">
                            <div class="menu-header-image opacity-2"
                                style="background-image: url('assets/images/dropdown-header/abstract1.jpg');"></div>
                            <div class="menu-header-content btn-pane-right">
                                <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                    <div class="avatar-icon rounded">
                                        <img  src="{{asset('images/employee_image/'.$item->emp_image.'')}}">
                                    </div>
                                </div>
                                <div>
                                    <h5 class="menu-header-title">{{$item->name}}</h5>
                                    <h6 class="menu-header-subtitle">{{$item->employee_id}}</h6>
                                    <h6 class="menu-header-subtitle">{{$item->designation}}-{{$department->Department_name}}</h6>
                                </div>
                                <div class="menu-header-btn-pane">
                                    @if ($item->active!=0)
                                    <button type="button" class="btn-wide btn-hover-shine btn-pill btn btn-primary">Active</button>
                                    @else
                                    <button type="button" class="btn-wide btn-hover-shine btn-pill btn btn-danger">In-Active</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="p-0 list-group-item">
                            <div class="grid-menu grid-menu-2col">
                                <div class="no-gutters row">
                                    <div class="col-sm-6">
                                        <div class="p-2">
                                            <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                <i class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"> </i>Attendence
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="p-2">
                                            <button class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                <i class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>Reports
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>


@endsection
