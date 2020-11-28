@extends('layouts.adminlayout.admin_design')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="lnr lnr-apartment"></i>
                    </div>
                    <div>Properties Ammenities

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
                        <h5 class="card-title">All Amminites</h5>
                        <form class="" method="post" action="{{url('/admin/amminites')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Ammenities Name</label>
                                        <input name="aname" id="exampleEmail11" placeholder="Property Name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Ammenities for</label>
                                        <select name="prop_select" class="form-control">
                                            <option value="residental">Residental</option>
                                            <option value="commercial">Commercial</option>
                                            <option value="plot">Plot for Development</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Ammenities image</label>
                                        <input name="aimage" id="exampleEmail11"  type="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
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
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">All Amminites</h5>
                        <div class="row">
                        @foreach ($amenities as $item)
                        <div class="col-md-4 col-xl-3">
                            <img src="{{asset('images/amminites_image/'.$item->icon_id.'')}}" class="">
                            <p style="font-size: 18px;font-weight: 600;">{{$item->amminites_name}}</p>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

