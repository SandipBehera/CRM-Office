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
                    <div>Lead status

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
                        <h5 class="card-title">Leads Status</h5>
                        <form class="" method="post" action="{{url('/crm-employee/status-update-leads')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Name</label>
                                        <input value="" id="exampleEmail11"  type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Email</label>
                                        <input value="" id="exampleEmail11"  type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Phone</label>
                                        <input value="" id="exampleEmail11"  type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Status</label>
                                        <select name="status" class=" form-control">
                                            <option value="">New</option>
                                            <option value="">Inprocess</option>
                                            <option value="">Follow Up</option>
                                            <option value="">Site Visit</option>
                                            <option value="">Hot</option>
                                            <option value="">Negotiation</option>
                                            <option value="">Closed</option>
                                            <option value="">Dead</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Next calling Date</label>
                                    <input type="text" class="form-control" name="nxd" data-toggle="datepicker">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Description</label>
                                        <textarea name="comments" value="" id="exampleEmail11"  type="text"  class="form-control"></textarea>
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
    </div>
@endsection
