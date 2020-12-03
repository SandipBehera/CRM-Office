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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>
<script src="https://cdn.tiny.cloud/1/thkq9jaj3afe8qqsrv45ufl3gh7cqyzvs9tclfh9zcugqog0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
</head>

<body onload="display_ct();">
@include('layouts.adminlayout.admin_header')
@include('layouts.adminlayout.admin_sidebar')
@yield('content')
@include('layouts.adminlayout.admin_fotter')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
{{--XLSX to JSON file converter--}}
<script>
        var uploadedfile;
        document.getElementById("excelfile").addEventListener("change",function(event){
            selectedfile=event.target.files[0];
            console.log("fileImported");
                var filereader=new FileReader();
                filereader.onload=function(event){
                    var data=event.target.result;
                    var workbook=XLSX.read(data,{type:"binary"});
                    workbook.SheetNames.forEach(element => {
                            let rawObject=XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                            let jsonObject=JSON.stringify(rawObject);
                            console.log(jsonObject);
        });
        document.getElementById("uploadexcel").addEventListener("click",function(){
            if(selectedfile){
                console.log("fileImported");
                var filereader=new FileReader();
                filereader.onload=function(event){
                    var data=event.target.result;
                    var workbook=XLSX.read(data,{type:"binary"});
                    workbook.SheetNames.forEach(element => {
                            let rawObject=XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                            let jsonObject=JSON.stringify(rawObject);
                            console.log(jsonObject);
                    });
                };
                FileReader.readAsBinaryString(uploadedfile);
            }
        });
    </script>
<script>
    function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
    }
    function display_ct() {
    var x = new Date()
    var x1=x.toUTCString();// changing the display to UTC string
    document.getElementById('datetime').innerHTML = x1;
    tt=display_c();
     }
     </script>
{{-- tinymce --}}
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
</script>
{{-- tinymce --}}
<script>
    tinymce.init({
      selector: '#mytextarea1'
    });
</script>
<!--field INcremnet Code-->
<script type="text/javascript">
    $(document).ready(function(){

        var addButton = $('#add_field'); //Add button selector
        var wrapper = $('#increment_input'); //Input field wrapper
        var fieldHTML = '<div class="form-row" id="increment_input"><div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail17" class="">Size Type</label><select name="size_type[]" id="exampleEmail17" class="form-control"><option value="1_BHK">1 Bhk</option><option value="2_BHK">2 Bhk</option><option value="3_BHK">3 Bhk</option><option value="4_BHK">4 Bhk</option></select></div></div><div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail18" class="">Size In SQFT</label><input name="size[]" id="exampleEmail18" placeholder="Size In SQFT" type="text" class="form-control"></div></div><div class="col-md-4"><div class="position-relative form-group"><label for="exampleEmail18" class="">Property Price</label><input name="price[]" id="exampleEmail18" placeholder="Property Price In lacs" type="text" class="form-control"></div></div></div>';
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
var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'fimage[]',
type: 'file',
id: 'file'
}), $("<br/><br/>")));
});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='col-md-4 abcd'><img id='previewimg" + abc + "' src=''/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
id: 'img',
src: 'https://www.freeiconspng.com/uploads/x-png-13.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};

});
</script>
{{-- Multiple images preview in browser --}}

<style>
#file{
  color:green;
  padding:5px;
  border:1px dashed #123456;
  background-color:#f9ffe5
  }
#property-gallery-photo-add{
  color:green;
  padding:5px;
  border:1px dashed #123456;
  background-color:#f9ffe5
  }

  #upload{
  margin-left:45px
  }
  #noerror{
  color:green;
  text-align:left
  }
  #error{
  color:red;
  text-align:left
  }
  #img{
  width:17px;
  border:none;
  height:17px;
  margin-left:-20px;
  margin-bottom:91px
  }
  .abcd{
  text-align:center
  }
  .abcd img{
  height:100px;
  width:100px;
  padding:5px;
  border:1px solid #e8debd
  }
  b{
  color:red
  }
  .pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;

}
  </style>
<script>
var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more_project').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'pimage[]',
type: 'file',
id: 'property-gallery-photo-add'
}), $("<br/><br/>")));
});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#property-gallery-photo-add', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg1' + z).remove();
$(this).before("<div id='abcd1" + abc + "' class='col-md-4 abcd'><img id='previewimg1" + abc + "' src=''/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd1" + abc).append($("<img/>", {
id: 'img',
src: 'https://www.freeiconspng.com/uploads/x-png-13.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg1' + abc).attr('src', e.target.result);
};

});
</script>
<!-- booking form images -->
<script>
    var abc = 0;      // Declaring and defining global increment variable.
    $(document).ready(function() {
    //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
    $('#booking_image_add').click(function() {
    $(this).before($("<div/>", {
    id: 'filediv'
    }).fadeIn('slow').append($("<input/>", {
    name: 'booking_form_img[]',
    type: 'file',
    id: 'Booking_form_img'
    }), $("<br/><br/>")));
    });
    // Following function will executes on change event of file input to select different file.
    $('body').on('change', '#Booking_form_img', function() {
    if (this.files && this.files[0]) {
    abc += 1; // Incrementing global variable by 1.
    var z = abc - 1;
    var x = $(this).parent().find('#previewimg2' + z).remove();
    $(this).before("<div id='abcd2" + abc + "' class='col-md-12 abcd'><img id='previewimg2" + abc + "' src=''/></div>");
    var reader = new FileReader();
    reader.onload = imageIsLoaded;
    reader.readAsDataURL(this.files[0]);
    $(this).hide();
    $("#abcd2" + abc).append($("<img/>", {
    id: 'img',
    src: 'https://www.freeiconspng.com/uploads/x-png-13.png',
    alt: 'delete'
    }).click(function() {
    $(this).parent().parent().remove();
    }));
    }
    });
    // To Preview Image
    function imageIsLoaded(e) {
    $('#previewimg2' + abc).attr('src', e.target.result);
    };

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
<!--Login/logout time recoreder-->
<script>
    $(document).on('click','#login',function(){
        var login=$(this).val();
        $.ajax({

            type:"post",
            url:"/crm-employee/attendence",
            data:{
                "_token":"{{csrf_token()}}",
                "logtype":login
            },
            success:function(res){
                if(res){
                    window.location.href='/crm-employee/attendence';
                    $('#success-alert-feature').show();
                    setTimeout(function(){$("#success-alert-feature").hide();},10000);
                }
            }

        });
    });
</script>
<script>
    $(document).on('click','#logout',function(){
        var logout=$(this).val();
        $.ajax({

            type:"post",
            url:"/crm-employee/attendence",
            data:{
                "_token":"{{csrf_token()}}",
                "logtype":logout
            },
            success:function(res){
                if(res){
                    window.location.href='/crm-employee/attendence';
                    $('#success-alert-feature1').show();
                    setTimeout(function(){$("#success-alert-feature1").hide();},10000);
                }
            }

        });
    });
</script>
<!--assign lead to employee -->
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

<script>
    $(document).on('click','#prior',function(){
        var banner_id=$(this).val();
        $.ajax({

            type:"post",
            url:"/prior",
            data:{
                "_token":"{{csrf_token()}}",
                "id":banner_id
            },
            success:function(res){
                if(res){
                    window.location.href='/admin/Frontend/banner';
                    $('#success-alert').show();
                    setTimeout(function(){$("#success-alert").hide();},50000);
                }
            }

        });
    });
</script>
<!-- Delete Properties -->
<script>
    $(document).on('click','#delete-property',function(){
        var prop_id=$(this).val();
        $.ajax({

            type:"post",
            url:"/prop-delete",
            data:{
                "_token":"{{csrf_token()}}",
                "id":prop_id
            },
            success:function(res){
                if(res){
                    window.location.href='/admin/property';
                    $('#success-alert').show();
                    setTimeout(function(){$("#success-alert").hide();},50000);
                }
            }

        });
    });
</script>
<!--Select Department -->
<script>
    $('#dept_name').change(function(){
        var dept_name=$(this).val();
        if(dept_name){
            $.ajax({

                method:"post",
                url:"/admin/employee_by_dept",
                data:{
                    "_token":"{{csrf_token()}}",
                     "id":dept_name
                    },
                success:function(res){
           if(res){
               $("#emp_name").empty();
               $("#emp_name").append('<option value=" ">Select</option>');
               $.each(res,function(key,value){
                   $("#emp_name").append('<option value="'+key+'">'+value+'</option>');
               });

           }else{
              $("#emp_name").empty();
           }
          }
       });
        }
    else{
       $("#emp_name").empty();
        }
    });
    </script>
    <!-- Date Filter For The Lead Report Generation-->
    <script>
        $('#lead_duration').change(function(){

            if($(this).val()=='5' ){
                $('#lead_from_date').show();
                $('#lead_to_date').show();
            }
            else{
                $('#lead_from_date').hide();
                $('#lead_to_date').hide();
            }
        });
        $("#lead_duration").trigger("change");
        </script>
    <!-- call The Post method for the Lead Report Generation -->
        <script>

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
        <div class="alert alert-success" id="success-alert-Assign" style="display:none">Lead Assigned Sucessfully</div>
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
