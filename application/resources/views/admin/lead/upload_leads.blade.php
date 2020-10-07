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
              <div class="row">

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Upload Leads
                                    </div>
                            <div class="card-body">
                                <!--upload page code-->
                            <form method="post" action="{{url('/admin/upload-leads')}}" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail55">Upload Leads In Excel Format</label>
                                        <input name="fupload" id="exampleEmail55" type="file" class="form-control" accept=".xlsx,.xls,.">
                                    </div>
                                    <div class="form-row">
                                        <div class="center-align" style="padding-left: 40%;padding-right:40%">
                                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                                        <input type="reset" class="btn btn-danger" name="cancel" value="Cancel">
                                        </div>
                                </div>
                            </form>
                            </div>
                        </div>
                </div>
        </div>
    </div>
@endsection
