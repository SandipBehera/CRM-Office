@php
    use App\Models\Properties;
@endphp
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
                    <div>Home page Banner Controller

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
                        <!--upload banners-->
                        <form method="POST" action="{{url('/admin/Frontend/banner')}}" enctype="multipart/form-data">
                         {{ csrf_field() }}
                            <div class="form-row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Property Name</label>
                                    <select name="property_name" class="form-control">
                                        <option name="">Select property name</option>
                                    @foreach ($porp as $item)
                                    <option value="{{$item->pid}}">{{$item->property_name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                             </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Banner Image</label>
                                    <input name="bimage" id="exampleEmail11" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Image Alt Text</label>
                                    <input name="balt" placeholder="Banner ALT Text" id="exampleEmail11" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Banner Large Text</label>
                                    <input name="bltext" placeholder="Banner Large Text" id="exampleEmail11" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Banner Small Text</label>
                                    <input name="bstext" placeholder="Banner Small Text" id="exampleEmail11" type="text" class="form-control">
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
                        <!--end upload banner-->
                        <!--All Banner Lists-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">All Asigned Leads</div>
                                    <div class="card-body">

                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Property Name</th>
                                                <th>Image</th>
                                                <th>status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($banner_list as $items)
                                                @php
                                                    $prop_name=Properties::where(['pid'=>$items->property_name])->first();
                                                    $i=1;
                                                @endphp
                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$prop_name->property_name}}</td>
                                                <td><img src="{{asset(url('images/banner_image/'.$items->banner_image.''))}}"></td>
                                                <td>
                                                    @if ($items->active!=0)
                                                    <button class="mb-2 mr-2 btn btn-shadow btn-gradient-alternate" id="prior" value="{{$items->id}}">Prior Property</button>
                                                    @else
                                                    <button class="mb-2 mr-2 btn btn-shadow btn-gradient-alternate" id="prior" value="{{$items->id}}">non-Prior Property</button>
                                                    @endif


                                                </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End All Banner Lists-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
