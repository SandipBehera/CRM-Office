<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lorven Companies : CMS & CRM Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

<link href="{{asset('css/main.css')}}" rel="stylesheet">
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/thkq9jaj3afe8qqsrv45ufl3gh7cqyzvs9tclfh9zcugqog0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>

<body>
@include('layouts.adminlayout.admin_header')
@include('layouts.adminlayout.admin_sidebar')
@yield('content')
@include('layouts.adminlayout.admin_fotter')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>


{{-- tinymce --}}
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
</script>

<!--field INcremnet Code-->
<script type="text/javascript">
    $(document).ready(function(){

        var addButton = $('#add_field'); //Add button selector
        var wrapper = $('#increment_input'); //Input field wrapper
        var fieldHTML = '<div class="form-row" id="increment_input"><div class="col-md-6"><div class="position-relative form-group"><label for="exampleEmail17" class="">Size Type</label><select name="size_type[]" id="exampleEmail17" class="form-control"><option value="1_BHK">1 Bhk</option><option value="2_BHK">2 Bhk</option><option value="3_BHK">3 Bhk</option><option value="4_BHK">4 Bhk</option></select></div></div><div class="col-md-6"><div class="position-relative form-group"><label for="exampleEmail18" class="">Size In SQFT</label><input name="size[]" id="exampleEmail18" placeholder="Size In SQFT" type="text" class="form-control"></div></div></div>';
                             //New input field html

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields

                $(wrapper).append(fieldHTML); //Add field html

        });
            $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html

        });
    });
    </script>
<!--Image Incement Button Codes-->
<script>
   $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
    $('#gallery-photo').on('change', function() {
        imagesPreview(this, 'div.gallery-extra');
    });
});
</script>
{{-- Multiple images preview in browser --}}
<script>
$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="col-md-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#property-gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.property-gallery');
    });
});
</script>
<script>
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img class="col-md-12" style="width:100%;height:100%">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#employee-gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.employee-gallery');
        });
    });
    </script>
<!--active the properties-->
<script>
    $(document).on('click','#active',function(){
        var property_id=$(this).val();
        $.ajax({

            type:"post",
            url:"/property-active",
            data:{
                "_token":"{{csrf_token()}}",
                "id":property_id
            },
            success:function(res){
                if(res){
                    $('#success-alert').show();
                    setTimeout(function(){$("#success-alert").hide();},50000);
                }
            }

        });
    });
</script>
<!--assign to the feature properties list-->
<script>
    $(document).on('click','#feature_properties',function(){
        var feature_properties=$(this).val();
        $.ajax({

            type:"post",
            url:"/feature-properties",
            data:{
                "_token":"{{csrf_token()}}",
                "id":feature_properties
            },
            success:function(res){
                if(res){
                    $('#success-alert-feature').show();
                    setTimeout(function(){$("#success-alert-feature").hide();},10000);
                }
            }

        });
    });
</script>
<script>
$(document).on('click','#Assign_Employee',function(){
    var Lead_id=$('#Leads').val();
    var Assign_Employee=$(this).val();
    $.ajax({
        type:"post",
            url:"/assign-leads",
            data:{
                "_token":"{{csrf_token()}}",
                "id":Lead_id,
                "Employee_id":Assign_Employee
            },

            success:function(res){
                if(res){
                    window.location.href="/admin/leads";
                    $('#success-alert-Assign').show();
                    setTimeout(function(){$("#success-alert-Assign").hide();},10000);
                }
            }
    });

});
</script>

</body>

</html>
@php
    use App\Models\Employee;
    use App\Models\Leads;
    $employees=Employee::where('user_type','!=','0')->get();

@endphp
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Assign Lead to</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Total leads Assigned</th>
                    <th>Closed</th>
                    <th>Pending</th>
                    <th>Dead Leads </th>
                    <th>Assigned To</th>

                </tr>
                </thead>
                <tbody>

                  @foreach ($employees as $item)
                    @php
                        $lead_assign=Leads::where(['asssigned_to'=>$item->employee_id])->count();
                    @endphp
                 <tr>
                    <td><img src="{{asset('images/employee_image/'.$item->emp_image.'')}}" style="width: 180px;height:130px"></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->employee_id}}</td>
                    <td>{{$lead_assign }}</td>
                    <td>Closed</td>
                    <td>In Progress</td>
                    <td>Pending</td>
                 <td><button type="button" class="btn mr-2 mb-2 btn-primary" id='Assign_Employee' value='{{$item->employee_id}}'>Assign</button></td>
                </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
