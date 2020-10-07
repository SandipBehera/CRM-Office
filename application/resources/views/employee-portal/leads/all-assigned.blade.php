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

                                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>mobile</th>
                                        <th>status</th>
                                        <th>Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($assigned_leads as $item)
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td><a href="{{url('/crm-employee/status-update-leads/'.$item->id.'')}}">{{$item->name}}</a></td>
                                        <td><a href="{{url('/crm-employee/status-update-leads/'.$item->id.'')}}">{{$item->email_id}}</a></td>
                                        <td><a href="{{url('/crm-employee/status-update-leads/'.$item->id.'')}}">{{$item->phone}}</a></td>
                                        <td></td>
                                        <td></td>
                                        </tr>
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
