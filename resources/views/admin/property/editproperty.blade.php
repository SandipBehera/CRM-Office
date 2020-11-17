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
                    <div>Edit Properties

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
                        <form class="" method="post" action="{{url('/admin/edit-property/'.$get_property->pid.'')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property Name</label>
                                    <input name="pname" id="exampleEmail11" placeholder="Property Name" type="text" class="form-control" value="{{$get_property->property_name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property By</label>
                                        <input name="pby" id="exampleEmail11" placeholder="Property BY" type="text" class="form-control" value="{{$get_property->property_by}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Property RERA Id</label>
                                        <input name="prera" id="exampleEmail11" placeholder="Property Rera ID" type="text" class="form-control" value="{{$get_property->property_rera}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail12" class="">Property Id</label>
                                        <input name="pid" id="exampleEmail12" placeholder="Property Id" type="text" class="form-control" value="{{$get_property->pid}}">
                                    </div>
                                </div>

                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail13" class="">Property Type</label>
                                    <select name="propety_type" id="exampleEmail13" class="form-control">
                                    <option value="Apartment" {{!empty($get_property->property_type=='Apartment')?'selected':''}} >Apartment</option>
                                    <option value="Villas" {{!empty($get_property->property_type=='Villas')?'selected':''}}>Villas</option>
                                    <option value="Commercials" {{!empty($get_property->property_type=='Commercials')?'selected':''}}>Commercials</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail13" class="">Property Status</label>
                                    <select name="propety_status" id="exampleEmail13" class="form-control">
                                    <option value="On Going" {{!empty($get_property->property_status=='On Going')?'selected':''}}>On Going</option>
                                    <option value="In Process" {{!empty($get_property->property_status=='In Process')?'selected':''}}>In Process</option>
                                    <option value="Ready To Move" {{!empty($get_property->property_status=='Ready To Move')?'selected':''}}>Ready To Move</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail14" class="">Property Description</label>
                                    <textarea id="mytextarea" name="desc"  >{{$get_property->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail15" class="">Property Meta Keywords</label>
                                        <textarea name="metakeywords" id="exampleEmail15" placeholder="Property Meta Keywords" type="textarea" class="form-control">{{$get_property->meta_description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail16" class="">Property Meta Descriptions</label>
                                        <textarea name="metadesc" id="exampleEmail16" placeholder="Property Meta Descriptions" type="textarea" class="form-control">{{$get_property->meta_keywords}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Project Location</h5>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail19" class="">Location</label>
                                        <input name="plocation" id="exampleEmail19" value="{{$get_property->location}}" placeholder="Ex:jubli hills,hyderabad" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail20" class="">City</label>
                                        <input name="pcity" id="exampleEmail20" value="{{$get_property->city}}" placeholder="Ex:Hyderabad" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail21" class="">State</label>
                                        <input name="pstate" id="exampleEmail21" value="{{$get_property->state}}" placeholder="Ex:Telangana" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail22" class="">Pincode</label>
                                        <input name="pincode" id="exampleEmail22" value="{{$get_property->pincode}}" placeholder="Ex:500031" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail22" class="">Google Map Location</label>
                                        <input name="gmap" id="exampleEmail22" placeholder="https://www.google.com/maps/embed?"  type="text" class="form-control">
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
                                    <input type="checkbox" name="amenities[]"  value="{{$item->id}}" class="form-check-input"><i class="{{$item->icon_id}}"></i>{{$item->amminites_name}}
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
                            @foreach ($get_property_details as $items)
                            <div class="form-row" id="increment_input">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail17" class="">Size Type</label>
                                        <select name="size_type[]" id="exampleEmail17" class="form-control">
                                            <option value="1_BHK" {{!empty($items->property_type=='Apartment')?'selected':''}}>1 Bhk</option>
                                            <option value="2_BHK" {{!empty($items->property_type=='Apartment')?'selected':''}}>2 Bhk</option>
                                            <option value="3_BHK" {{!empty($items->property_type=='Apartment')?'selected':''}}>3 Bhk</option>
                                            <option value="4_BHK" {{!empty($items->property_type=='Apartment')?'selected':''}}>4 Bhk</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail18" class="">Size In 'SQFT'</label>
                                    <input name="size[]" id="exampleEmail18" placeholder="Size In SQFT"  value="{{$items->property_size}}" type="text" class="form-control">
                                    </div>
                                </div>
                        </div>
                            @endforeach


                            <div class="divider"></div>
                            <h5 class="card-title">Floor plan Images</h5>
                            <div class="from-row">
                                @if (!empty($get_property_floor_image))
                                @foreach ($get_property_floor_image as $floor_image)
                                <span class="pip"><img src="{{asset('images/property_image/small/'.$floor_image->floor_image)}}"><br>
                                <span class="remove"><a href="{{ url('#') }}" class="btn btn-danger">Delete</a>
                                </span>
                                </span>
                                @endforeach
                                <div class="col-md-12">
                                    <div id="filediv" style="padding-bottom: 20px"><input name="fimage[]" type="file" id="file" /></div>
                                    <input type="button" id="add_more" class="btn btn-success" value="Add More Images" />
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div id="filediv" style="padding-bottom: 20px"><input name="fimage[]" type="file" id="file"/></div>
                                    <input type="button" id="add_more" class="btn btn-success" value="Add More Images" />
                                </div>
                                @endif

                             </div>
                            <div class="divider"></div>
                            <h5 class="card-title">Project Images</h5>
                            <div class="form-row">
                                @if (!empty($get_property_details_image))
                                @foreach ($get_property_details_image as $prop_image)
                                <span class="pip"><img src="{{asset('images/property_image/small/'.$prop_image->property_image)}}"><br>
                                <span class="remove"><a href="{{ url('#') }}" class="btn btn-danger" >Delete</a>
                                </span>
                                </span>
                                @endforeach
                                <div class="col-md-12">
                                    <div id="filediv" style="padding-bottom: 20px"><input name="pimage[]" type="file" id="property-gallery-photo-add"/></div>
                                    <input type="button" id="add_more_project" class="btn btn-success" value="Add More Images" />
                                </div>
                                @else
                            <div class="col-md-12">
                                <div id="filediv" style="padding-bottom: 20px"><input name="pimage[]" type="file" id="property-gallery-photo-add" /></div>
                                <input type="button" id="add_more_project" class="btn btn-success" value="Add More Images" />
                            </div>
                            @endif
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
