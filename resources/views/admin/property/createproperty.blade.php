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
                    <div>Create New Properties

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
                        <h5 class="card-title">Project Information</h5>
                        <form class="" method="post" action="{{url('/admin/create-property')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property Name</label>
                                        <input name="pname" id="exampleEmail11" placeholder="Property Name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property By</label>
                                        <input name="pby" id="exampleEmail11" placeholder="Property BY" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property RERA Id</label>
                                        <input name="prera" id="exampleEmail11" placeholder="Property Rera ID" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail12" class="">Property Id</label>
                                        <input name="pid" id="exampleEmail12" placeholder="Property Id" type="text" class="form-control">
                                    </div>
                                </div>

                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail13" class="">Property Type</label>
                                    <select name="propety_type" id="exampleEmail13" class="form-control">
                                    <option value="Apartment">Apartment</option>
                                    <option value="Villas">Villas</option>
                                    <option value="Commercials">Commercials</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail13" class="">Property Status</label>
                                    <select name="propety_status" id="exampleEmail13" class="form-control">
                                    <option value="On Going">On Going</option>
                                    <option value="In Process">In Process</option>
                                    <option value="Ready To Move">Ready To Move</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail14" class="">Property Name</label>
                                       <textarea id="mytextarea" name="desc"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail15" class="">Property Meta Keywords</label>
                                        <textarea name="metakeywords" id="exampleEmail15" placeholder="Property Meta Keywords" type="textarea" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail16" class="">Property Meta Descriptions</label>
                                        <textarea name="metadesc" id="exampleEmail16" placeholder="Property Meta Descriptions" type="textarea" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Project Location</h5>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail19" class="">Location</label>
                                        <input name="plocation" id="exampleEmail19" placeholder="Ex:jubli hills,hyderabad" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail20" class="">City</label>
                                        <input name="pcity" id="exampleEmail20" placeholder="Ex:Hyderabad" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail21" class="">State</label>
                                        <input name="pstate" id="exampleEmail21" placeholder="Ex:Telangana" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail22" class="">Pincode</label>
                                        <input name="pincode" id="exampleEmail22" placeholder="Ex:500031" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail22" class="">Google Map Location</label>
                                        <input name="gmap" id="exampleEmail22" placeholder="https://www.google.com/maps/embed?" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <h5 class="card-title">amenities</h5>
                            <div class="form-row">
                                @if ($amenities!='')
                                @foreach ($amenities as $item)
                                <div class="position-relative form-check form-check-inline">
                                    <label class="form-check-label">
                                    <input type="checkbox" name="amenities[]" value="{{$item->id}}" class="form-check-input"><img src="{{asset('images/amminites_image/'.$item->icon_id.'')}}">{{$item->amminites_name}}
                                    </label>
                                </div>
                                @endforeach
                                @else
                                <p class="form-check-label">
                                    No Amenities In Record
                                </p>
                                @endif
                            </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Project Information <span style="padding-left: 65%"><a href="javascript:void(0);" id="add_field"> Add More</a></span></h5>
                            <div class="form-row" id="increment_input">
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail17" class="">Size Type</label>
                                            <select name="size_type[]" id="exampleEmail17" class="form-control">
                                                <option value="1_BHK">1 Bhk</option>
                                                <option value="2_BHK">2 Bhk</option>
                                                <option value="3_BHK">3 Bhk</option>
                                                <option value="4_BHK">4 Bhk</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail18" class="">Size In 'SQFT'</label>
                                            <input name="size[]" id="exampleEmail18" placeholder="Size In SQFT" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="exampleEmail18" class="">Property Price</label>
                                            <input name="price[]" id="exampleEmail18" placeholder="Property Price in Lacs" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            <div class="divider"></div>
                            <h5 class="card-title">Floor plan Images</h5>
                            <div class="from-row">
                                <div class="col-md-12">
                                    <div id="filediv" style="padding-bottom: 20px"><input name="fimage[]" type="file" id="file" required/></div>
                                    <input type="button" id="add_more" class="btn btn-success" value="Add More Images" />
                                </div>
                             </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Project Images</h5>
                            <div class="form-row">
                            <div class="col-md-12">
                                <div id="filediv" style="padding-bottom: 20px"><input name="pimage[]" type="file" id="property-gallery-photo-add" required/></div>
                                <input type="button" id="add_more_project" class="btn btn-success" value="Add More Images" />
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
    </div>

@endsection
