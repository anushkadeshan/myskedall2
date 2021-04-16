@extends('platform/template')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .modal-backdrop {
  z-index: -1;
}
/* Style the form */
#view {
background-color: #ffffff;
margin: 10px auto;
width: 70%;
min-width: 300px;
}


#progress {
background-color: #ffffff;
margin: 10px auto;
margin-top: 30px;
padding: 40px;
min-width: 300px;
}
/* Style the input fields */
input {
padding: 10px;
width: 100%;
font-size: 17px;
font-family: Raleway;
border: 1px solid #aaaaaa;
}

select {
padding: 10px;
width: 100%;
font-size: 17px;
font-family: Raleway;
border: 1px solid #aaaaaa;
}

textarea{
padding: 10px;
width: 100%;
font-size: 17px;
font-family: Raleway;
border: 1px solid #aaaaaa;
}


/* Mark input boxes that gets an error on validation: */
input.invalid {
background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
display: none;
}



/* Make circles that indicate the steps of the form: */
.step {
}

/* Mark the active step: */
.step.active {
opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
background-color: #4CAF50;
}

.img-wrap {
    position: relative;
    ...
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    ...
}

</style>
@section('content')
<div id="view">
    <div class="tab">
        <h3 class="text-center">{{__('msg.Location Details')}} </h3>
         <table class="table">
            <tbody>
                
                <tr>
                    <td>{{__('msg.name')}} : </td>
                    <td><font class="text-muted">{{$data->name}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Address')}} : </td>
                    <td><font class="text-muted">{{$data->address}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Contact Person')}} : </td>
                    <td><font class="text-muted">{{$data->contact}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Telephone')}} : </td>
                    <td><font class="text-muted">{{$data->telephone}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Quantity of People')}} : </td>
                    <td><font class="text-muted">{{$data->quantity}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Location Type')}} : </td>
                    <td><font class="text-muted">{{$data->location_type}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Period')}} : </td>
                    <td><font class="text-muted">{{$data->period}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Size')}} : </td>
                    <td><font class="text-muted">{{$data->size}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Area Type')}} : </td>
                    <td><font class="text-muted">{{$data->area_type}}</font></td>
                </tr>
            
            </tbody>
        </table>
    </div>
    <div class="tab">
        <h3 class="text-center">{{__('msg.Location Details')}} </h3>
         <table class="table">
            <tbody>
                <tr>
                    <td>{{__('msg.Air Conditionar')}} : </td>
                    <td><font class="text-muted">{{$data->air_conditioner}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Total People')}} : </td>
                    <td><font class="text-muted">{{$data->total_people}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Total Chair')}} : </td>
                    <td><font class="text-muted">{{$data->total_chair}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Total Table')}} : </td>
                    <td><font class="text-muted">{{$data->total_table}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Parking')}} : </td>
                    <td><font class="text-muted">{{$data->parking}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Price')}} : </td>
                    <td><font class="text-muted">{{$data->price}}</font></td>
                </tr>
                <tr>
                    <td>{{__('msg.Budget')}} : </td>
                    <td><font class="text-muted">{{$data->budget}}</font></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab">
        <h3 class="text-center">{{__('msg.Photos')}} </h3>
        <hr>
        <div id="carouselExampleControls{{$data->id}}" class="carousel slide" data-ride="carousel" >
            <div class="carousel-inner">
                @if($data->photos != "")
                    @foreach(explode(',', $data->photos) as $info)
                        
                        @if(preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.JPG|\.PNG)$/i',$info))  
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" height="250" src="{{asset('_dados/plataforma/location/images/'.$info)}}">
                            </div>
                        @endif
                    @endforeach
                @endif
                <a class="carousel-control-prev" href="#carouselExampleControls{{$data->id}}" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{__('msg.keyword')}} Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls{{$data->id}}" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">{{__('msg.Next')}} </span>
                </a>
                
            </div>
        </div>
        <hr>
        <h4>{{__('msg.Sketchs')}} </h4>
        @if($data->sketch != "")
            @foreach(explode(',', $data->sketch) as $info)
                @if(preg_match('/(\.pdf|\.doc|\.docx|\.csv|\.xlsx)$/i',$info))  
                    <a href="{{asset('_dados/plataforma/location/sketch/'.$info)}}">
                        <img style="margin-bottom: 5px;" src="{{asset('img/document.png')}}" alt="">
                        {{$info}}
                    </a>
                    <br>
                @else
                <font class="text-muted">{{__('msg.Not Found')}} </font>
                @break
                @endif
            @endforeach
        @endif

    </div>
    <div class="tab">
         <h3 class="text-center">{{__('msg.Blue Prints')}} </h3>
         <hr>
        <h4>{{__('msg.All Documents')}} </h4>
        @if($data->blue_print != "")
            @foreach(explode(',', $data->blue_print) as $info)
                @if(preg_match('/(\.pdf|\.doc|\.docx|\.xlsx)$/i',$info))  
                    <a href="{{asset('_dados/plataforma/location/blue_print/'.$info)}}">
                        <img style="margin-bottom: 5px;" src="{{asset('img/document.png')}}" alt="">
                        {{$info}}
                    </a>
                    <br>
                @endif
            @endforeach
        @endif
    </div>
    <div class="tab"><h3 class="text-center">{{__('msg.Items')}}</h3> :
        <p><h4>{{__('msg.Metirial Resources')}}</h4>
          @foreach($materials as $material)
            <div class="row">
                <div class="col-md-10">
               
                    <label for="chb{{$material->id}}">{{$material->material}}</label>
                   
                </div> 
                <div class="col-md-2">
                @php 
                    if(in_array($material->id, $selected_materials) )  {
                        $quantity = DB::table('location_materials')
                            ->where('location_id',$data->id)
                            ->where('material_id',$material->id)
                            ->first();

                        $m_quantity = $quantity->quantity;
                    }
                    else{
                        $m_quantity = 1;
                    }
                @endphp
                <label for="">{{$m_quantity}}</label>
                </div>
            </div> 
            <br>
          @endforeach
        </p>
        <h4>{{__('msg.Human Resources')}}</h4> :
        <p>
          @foreach($functions as $function)
          <div class="row">
            <div class="col-md-10">
              
                <label for="chbf{{$function->id}}">{{$function->professional}}</label>
                
            </div> 
            <div class="col-md-2">
                @php 
                    if(in_array($function->id, $selected_functions) )  {
                        $quantity = DB::table('location_functions')
                            ->where('location_id',$data->id)
                            ->where('function_id',$function->id)
                            ->first();

                        $f_quantity = $quantity->quantity;
                    }
                    else{
                        $f_quantity = 1;
                    }
                @endphp
            <label for="">{{$f_quantity}}</label>
            </div>
          </div> 
          <br>
          @endforeach
        </p>
    </div>
    <div class="tab">
        <h3 class="text-center">{{__('msg.List of Rules')}} </h3>
         <hr>
        <table class="table table-borderless">
            @php
                $no = 1;
                $rules = DB::table('space_location_rules')->where('location_id',$data->id)->get();
            @endphp
            <tr>
                <th></th>
                <th>{{__('msg.Rule Name')}}</th>
                <th>{{__('msg.Responsible')}} </th>
                <th>{{__('msg.Documents')}} </th>
                <th>{{__('msg.Crerated At')}} </th>
            </tr>
            @foreach($rules as $rule)
            <tr>
                <td width="10">{{$no++}}</td>
                    <td>{{$rule->rule_name}}</td>
                    <td>{{$rule->responsible}}</td>
                    <td><a href="{{asset('_dados/plataforma/location/rules/'.$rule->rules_documents)}}"><img height="24px" src="{{asset('img/document.png')}}" alt=""></a></td>
                    <td>{{$rule->created_at}}</td>
                </tr>
            @endforeach
        </table>
        {{__('msg.Notes')}} :
            <p>
                {{$data->notes}}
            </p>
    </div>

    <div style="overflow:auto; margin-top:10px;">
        <div style="float:right;">
            <button type="button" id="prevBtn"  onclick="nextPrev(-1)">Previous <i class="fa fa-chevron-circle-left"></i></button>
           <button type="button" id="nextBtn"  onclick="nextPrev(1)">Next <i class="fa fa-chevron-circle-right"></i></button>
        </div>
    </div>

    <div style="text-align:center;margin-top:40px;">
        <div class="row">
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">1 <br> Location ID</button></div>
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">2 <br> Type</button></div>
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">3 <br> Parameters</button></div>
        </div>
        <br> 
        <div class="row">
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">4 <br> Files</button></div>
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">5 <br> Resourses</button></div>
            <div class="col-md-4"><button type="button" value="" class="step btn btn-lg btn-primary col-md-12">6 <br> Rules and Finish</button></div>
            
        </div>
        <br>
        <div id="progress col-md-12">
            <div class="progress">
                <div id="progress-bar" class="progress-bar progress-bar-striped active" role="progressbar"
                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                40%
                </div>
            </div>
        </div>
    </div>
</div>
@csrf
<!-- Circles which indicates the steps of the form: -->

<!-- Models -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

function showQuantity(a,id){
    if($( a ).is( ":checked" )){
      $("#qty"+id).attr("disabled", false);
    }
    else{
      $("#qty"+id).attr("disabled", true);
    }
  }
  
  function showQuantityF(a,id){
    if($( a ).is( ":checked" )){
      $("#qtyF"+id).attr("disabled", false);
    }
    else{
      $("#qtyF"+id).attr("disabled", true);
    }
  }

//open sketh edit model
function skethEdit(id){
    $('#sketchModal').appendTo("body").modal('show');
}

function bluePrintEdit(id){
    $('#bluePrintModal').appendTo("body").modal('show');
}

function RulesEdit(id){
    $('#RulesModal').appendTo("body").modal('show');
}

$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><th><input type="text" name="rule_name[]" class="form-control name-list"></th><td><input type="text" name="responsible[]" class="form-control position-list"></td><td><input type="file" name="rules_documents[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });

function deleteFile(id,file){
    $.ajax({
		url:BaseUrl+'/admin/delete-location-sketch-file',
        type:'GET',
        datatype:'json',
        data: {
            id : id,
            file : file,
        },
        success: function(response) {
            if(response['status']=='success'){
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'success');

            }else{
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'danger');
			}
        }
    });
}

function deletePhoto(id,file){
    $.ajax({
		url:BaseUrl+'/admin/delete-location-photo',
        type:'GET',
        datatype:'json',
        data: {
            id : id,
            file : file,
        },
        success: function(response) {
            if(response['status']=='success'){
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'success');

            }else{
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'danger');
			}
        }
    });
}

function deleteRule(id,file){
    $.ajax({
		url:BaseUrl+'/admin/delete-location-rule',
        type:'GET',
        datatype:'json',
        data: {
            id : id,
            file : file,
        },
        success: function(response) {
            if(response['status']=='success'){
                Alert(response['message'], 'success');
                $('.rule' +id).remove();

            }else{
                Alert(response['message'], 'danger');
			}
        }
    });
}

function deleteBluePrint(id,file){
    $.ajax({
		url:BaseUrl+'/admin/delete-location-blue-print-file',
        type:'GET',
        datatype:'json',
        data: {
            id : id,
            file : file,
        },
        success: function(response) {
            if(response['status']=='success'){
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'success');

            }else{
                document.getElementById(file).style.display = "none";
                Alert(response['message'], 'danger');
			}
        }
    });
}

 var previousTab = 0;
  function changeTab(n){
        var x = document.getElementsByClassName("tab");
        
        x[previousTab].style.display = "none";
        x[n].style.display = "block";
        previousTab = n;

        
        //alert(x);
      }

var currentTab = 0; // Current tab is set to be the first tab (0)
var progress = 0;
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    
    document.getElementById("nextBtn").innerHTML = "{{__('msg.finish')}}";
    $('#nextBtn').wrapInner('<a href="{{url("admin/location-management")}}" class="remove-thing"></a>');
    
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  if(n==1){
    if(progress==100){
        progress = 100;
    }
    else{
    progress = progress + 20
    document.getElementById("progress-bar").innerHTML = progress+"%";
    document.getElementById("progress-bar").style.width = progress+"%";
    }
    
    
    
  }
  else{
    progress = progress - 20;
    document.getElementById("progress-bar").innerHTML = progress+"%";
    document.getElementById("progress-bar").style.width = progress+"%";
  }
 // alert(currentTab);
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  previousTab = currentTab;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

$(document).ready(function(){
    var t = sessionStorage.getItem("currentTab");
    console.log("document ready session", t);

        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        if(t == null || t>=6){
            currentTab = 0;  
            document.getElementById("progress-bar").innerHTML = "0%";
            document.getElementById("progress-bar").style.width = "0%";
            sessionStorage.setItem("currentTab", currentTab);         
        }else{
            currentTab = parseInt(t);
            if(progress==100){
                progress = 100
            }
            else{
                progress = currentTab*20
            }
            document.getElementById("progress-bar").innerHTML = progress+"%";
            document.getElementById("progress-bar").style.width = progress+"%";
        }
        
        // Otherwise, display the correct tab:
        showTab(currentTab);
    

});
</script>

@endsection
