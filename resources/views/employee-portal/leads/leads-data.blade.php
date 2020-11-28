@php
    use App\Models\LeadTransfer;
    use App\Models\Employee;
@endphp
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
                        <form class="" method="post" action="{{url('/crm-employee/status-update-leads/'.$lead_details->id.'')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Name</label>
                                    <input  id="exampleEmail11" value="{{$lead_details->name}}" type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Email</label>
                                        <input  id="exampleEmail11" value="{{$lead_details->email_id}}"  type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Phone</label>
                                        <input value="{{$lead_details->phone}}"  id="exampleEmail11"  type="text"  class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Lead Status</label>
                                        <select name="status" class=" form-control" id='lead_status'>
                                            <option value="new">New</option>
                                            <option value="Inprocess">Inprocess</option>
                                            <option value="follow up">Follow Up</option>
                                            <option value="site visit Initate">Site Visit Initiate</option>
                                            <option value="site visit Done">Site Visit Done</option>
                                            <option value="negotiation">Negotiation</option>
                                            <option value="closed">Closed</option>
                                            <option value="dead">Dead</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id='lead_s_visit'>
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Site Visit Assign to</label>
                                        <select name="visit_assign" class=" form-control" >
                                            <option value="">Assigned Person Name</option>
                                            @foreach ($site_visit_employee_all as $item_permission)
                                                <option value="{{$item_permission->employee_id}}">{{$item_permission->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="nexdate">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Next calling Date</label>
                                    <input type="text" class="form-control" name="nxd" data-toggle="datepicker"  autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-4" id="description">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail11" class="">Description</label>
                                        <textarea name="comments" value="" id="exampleEmail11"  type="text"  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" id='closed_form'>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Booking Registered Name <a href="javascript:void(0)" style="padding-left:20px " id="edit_name">Edit</a></label>
                                    <div id="booked_person_name">

                                    </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group" id="">
                                    <label for="exampleEmail11" class="">Property Name <a href="javascript:void(0)" style="padding-left:20px " id="edit_property">Edit</a></label>
                                        <div id="propety_entry">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Booking Unit </label>
                                    <input type="text" class="form-control" name="booking_unit"  autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                    <label for="exampleEmail11" class="">Booking Form Images</label>
                                    <input type="file" class="form-control" name="booking_form_img[]" id="Booking_form_img">
                                    <input type="button" id="booking_image_add" class="btn btn-success" value="Add More Images" />
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
                        <!--leads data-->
                        @if ($leads_comments_count>0)


                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Leads Status</th>
                                <th>Follow up date </th>
                                <th>Comments</th>
                                <th>Leads Assigned to</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads_comments as $leads_com)
                                <tr>
                                    <td>{{$leads_com->lead_status}}</td>
                                    <td>{{$leads_com->followup_date}}</td>
                                    <td>{{$leads_com->comment}}</td>
                                    <td>@if ($leads_com->lead_status=='site visit Initate')
                                        @php
                                            $lead_transfer=LeadTransfer::where('lead_id','=',$lead_details->id)->first();
                                            $employee=Employee::where('employee_id','=',$lead_transfer->lead_to)->first();
                                            echo $employee->name;
                                        @endphp
                                    @else
                                        NO records of transfer
                                    @endif</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>


                        @endif

                        <!--end leads data-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#lead_status').change(function(){
            var lead_for='{{$lead_details->leads_for}}'
            if($(this).val()=='site visit Initate' && lead_for !='Keyon Plus' ){
                $('#lead_s_visit').show();
                $('#closed_form').hide();
                $('#description').show();
                $('#nexdate').show();

            }
            else if($(this).val()=='closed' && lead_for !='Keyon Plus'){
                $('#nexdate').hide();
                $('#lead_s_visit').hide();
                $('#description').hide();
                $('#closed_form').show();

            }
            else{
                $('#lead_s_visit').hide();
                $('#closed_form').hide();
                $('#description').show();
                $('#nexdate').show();
            }
        });
        $("#lead_status").trigger("change");
        </script>
<script>
    //change the property to input tag to select tag
    function getTxtBox(){
        return '<input type="text" class="form-control" name="booked_porp_name" value="{{Session::get("project_name")}}"  id="lead_property" readonly>';
    }
    function getSltBox(){
        return['<select name="booked_porp_name" class="form-control" id="select_property">',
                                    @foreach ($property_list as $item_property)
                                    '<option value="Keyonproperties-{{$item_property->property_name}}">{{$item_property->property_name}}</option>',
                                    @endforeach
                                    '</select>'].join('');
    }
    $('#propety_entry').html(getTxtBox());
    $(document).on('click','#edit_property',function(){
        $('#propety_entry').html(getSltBox());

    });
 //change the property to input readonly tag to input tag
 function getInxtBox(){
        return '<input type="text" class="form-control" name="client_name" value="{{$lead_details->name}}"  readonly>';
    }
    function getNewTxtBox(){
        return'<input type="text" class="form-control" name="client_name" >';
    }
    $('#booked_person_name').html(getInxtBox());
    $(document).on('click','#edit_name',function(){
        $('#booked_person_name').html(getNewTxtBox());

    });
    </script>

@endsection
