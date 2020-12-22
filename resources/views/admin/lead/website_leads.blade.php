
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
                    <div>All Website Quries

                    </div>
                </div>

             </div>
        </div>

              <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Website Quries
                                    </div>
                            <div class="card-body">

                                <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>mobile</th>
                                        <th>Message</th>
                                        <th>Leads For</th>
                                        <th>Assigned To</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($fetch_quires as $item)
                                        <tr>
                                            <td>{{$item->client_name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->phone}}</td>
                                            @if ($item->message!=NULL)
                                            <td>{{$item->message}}</td>
                                            @else
                                                <td>No message to display</td>
                                            @endif
                                            <td>{{$item->query_from}}</td>
                                            @if ($item->assign_to!=NULL)
                                            <td>{{$item->assign_to}}</td>
                                            @else
                                            <td> <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal"
                                            data-target=".bd-example-modal-lg" id="Leads" value="{{$item->id}}">Assign</button></td>
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
    <!-- Large modal -->


@endsection
