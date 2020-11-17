@php
    use App\Models\Properties_details;
    use App\Models\property_image;
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
                    <div>All Property List

                    </div>
                </div>

             </div>
        </div>
        <div class="alert alert-success" id="success-alert" style="display:none"> Successfully active property</div>
        <div class="alert alert-success" id="success-alert-feature" style="display:none">Property Added to feature properties list</div>
        {{-- @foreach ($fields as $field)
        {{$field->name}}
        @endforeach --}}
        <div class="row">
                @foreach ($property as $item)
                @php
                    $property_details=Properties_details::where('pid',$item->pid)->first();
                    $property_image=property_image::where(['pid'=>$item->pid])->where('property_image','!=',null)->first();

                    $description=strip_tags($item->description)
                @endphp

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                        <div class="card-header">{{$item->property_name}}</div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-4 ">
                                <img src="{{asset('images/property_image/large/'.$property_image->property_image.'')}}" style="width: 100%;height:100%">
                                </div>
                                <div class="col-md-8">
                                    {{$description}}
                                </div>
                                </div>
                                </div>
                            <div class="d-block text-right card-footer">
                            <button class="mb-2 mr-2 btn btn-shadow btn-gradient-primary" id="active" value="{{$item->id}}">
                                @if ($item->active==0)
                                    Inactive
                                @else
                                Active
                                @endif

                            </button>
                            <a href="{{url('/admin/edit-property/'.$item->pid.'')}}" class="mb-2 mr-2 btn btn-shadow btn-gradient-success">View</a>
                                <button class="mb-2 mr-2 btn btn-shadow btn-gradient-alternate" id="feature_properties" value="{{$item->id}}">Feature Property</button>
                                <button class="mb-2 mr-2 btn btn-shadow btn-danger" id="delete-property" value="{{$item->pid}}">Delete Property</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
    </div>


@endsection
