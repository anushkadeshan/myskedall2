@extends('platform/template')
@section('content')
<style>
/* Style the form */
#regForm {
background-color: #ffffff;
margin: 10px auto;
padding: 40px;
width: 70%;
min-width: 300px;
}

#progress {
background-color: #ffffff;
margin: 10px auto;
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


</style>
<!------ Include the above in your HEAD tag ---------->

<form id="regForm" action="{{url('admin/add-location/')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <h1>{{__('msg.Location Creation')}} :</h1>

    <!-- One "tab" for each step in the form: -->
    <div class="tab" id="basic">{{__('msg.name')}} :
        <p><input placeholder="Name" name="name" type="text" oninput="this.className = ''"></p>
       {{__('msg.Address')}} :
        <p><input placeholder="Address" name="address" type="text" oninput="this.className = ''"></p>
       {{__('msg.Contact Person')}} :
        <p><input placeholder="Name of Contact Person" name="contact" type="text" oninput="this.className = ''"></p>
       {{__('msg.Telephone')}} :
        <p><input placeholder="Telephone" name="telephone" type="text" oninput="this.className = ''"></p>
    </div>

    <div class="tab">{{__('msg.Quantity of People')}} :
        <p><input placeholder="Quantity" type="text" name="quantity" oninput="this.className = ''"></p>
       {{__('msg.Location Type')}} :
        <p>
          <select name="location_type" id="" oninput="this.className = ''">
            @foreach($locationTypes as $type)
            <option value="{{$type->location_type}}">{{$type->location_type}}</option>
            @endforeach
          </select>
        </p>
       {{__('msg.Period')}} :
        <p><input placeholder="Period" type="text" name="period" oninput="this.className = ''"></p>
       {{__('msg.Size')}} :
        <p><input placeholder="Size should be in Feets" type="text" name="size" oninput="this.className = ''"></p>
       {{__('msg.Area Type')}} :
        <p>
        <select name="area_type" oninput="this.className = ''">
            <option>Covered</option>
            <option>Uncovered</option>
        </select>
        </p>

    </div>

    <div class="tab">
    {{__('msg.Air Conditionar')}} :
        <p>
        <select name="air_conditioner" oninput="this.className = ''">
            <option>Yes</option>
            <option>No</option>
        </select>
        </p>
       {{__('msg.Total People')}} :
        <p><input placeholder="Total People" name="total_people" type="number" oninput="this.className = ''"></p>
       {{__('msg.Total Chair')}} :
        <p><input placeholder="Total Chair" name="total_chair" type="number" oninput="this.className = ''"></p>
       {{__('msg.Total Table')}} 
        <p><input placeholder="Total Table" name="total_table" type="number" oninput="this.className = ''"></p>
       {{__('msg.Parking')}} 
        <p>
        <select name="parking" oninput="this.className = ''">
            <option>Yes</option>
            <option>No</option>
        </select>
        </p>
       {{__('msg.Price')}} :
        <p><input placeholder="Price" name="price" type="number" oninput="this.className = ''"></p>
       {{__('msg.Budget')}} :
        <p><input placeholder="Budget" name="budget" type="number" oninput="this.className = ''"></p>
    </div>

    <div class="tab">{{__('msg.Photos')}} :
        <p><input placeholder="Photos" type="file" multiple name="photos[]" oninput="this.className = ''"></p>
        {{__('msg.Skecth')}} :
        <p><input placeholder="Sketch" type="file" multiple name="sketch[]" oninput="this.className = ''"></p>
       {{__('msg.Blue Print')}} :
        <p><input placeholder="Blue Print" type="file" multiple name="blue_print[]" oninput="this.className = ''"></p>
       
    </div>

    <div class="tab"><strong>{{__('msg.Metirial Resources')}}</strong> :
        <p>
          @foreach($materials as $material)
          <div class="row">
            <div class="col-md-10">
              <div class="icheck-primary icheck-inline">                         
                <input id="chb{{$material->id}}" type="checkbox" value="{{$material->id}}" onclick="showQuantity(this,{{$material->id}})" name="materials[]" />
                <label for="chb{{$material->id}}">{{$material->material}}</label>
                </div>
            </div> 
            <div class="col-md-2">
              @php
                $maxm = $material->quantity - $material->allocated;
              @endphp
              <input type="number" disabled id="qty{{$material->id}}" min="0" name="m_quantity[]" max="{{$maxm}}" value="1" class="form-control">
            </div>
          </div> 
          <br>
          @endforeach
        </p>
        <strong>{{__('msg.Human Resources')}}</strong> :
        <p>
          @foreach($functions as $function)
          <div class="row">
            <div class="col-md-10">
              <div class="icheck-primary icheck-inline">                         
                <input id="chbf{{$function->id}}" type="checkbox" value="{{$function->id}}" onclick="showQuantityF(this,{{$function->id}})" name="functions[]" />
                <label for="chbf{{$function->id}}">{{$function->professional}}</label>
                </div>
            </div> 
            <div class="col-md-2">
              @php
                $maxf = $function->quantity - $function->allocated;
              @endphp
              <input type="number" disabled id="qtyF{{$function->id}}" min="0" name="f_quantity[]" max="{{$maxf}}" value="1" class="form-control">
            </div>
          </div> 
          <br>
          @endforeach
        </p>
    </div>

    <div class="tab">{{__('msg.Rules')}} :
        <p>
          <table class="table table-borderless" id="dynamic_field">
            <thead>
                    <tr>
                    <th scope="col">{{__('msg.Rule Name')}} </th>
                    <th scope="col">{{__('msg.Responsible')}} </th>
                    <th scope="col">{{__('msg.Documents')}} </th>
                    <th scope="col"></th>
                    </tr>
            </thead>
            <tbody>
              <tr>
              <th><input type="text" name="rule_name[]" class="form-control name-list"></th>
              <td><input type="text" name="responsible[]" class="form-control position-list"></td>
              <td><input type="file" name="rules_documents[]" class="form-control branch-list"></td>
              <td><button type="button" class="btn btn-success btn-flat" id="add"><i class="fa fa-plus"></i></button></td>
              </tr>
            </tbody>
					</table>
        </p>
        {{__('msg.Notes')}} :
        <p>
            <textarea name="notes" placeholder="Write your Notes Here" oninput="this.className = ''"></textarea>
        </p>
    </div>

    <div style="overflow:auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">{{__('msg.Previous')}} </button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)"> {{__('msg.Next')}} </button>
        </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
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
                
                </div>
            </div>
        </div>
    </div>
      
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

  var previousTab = 0;
  function changeTab(n){
        var x = document.getElementsByClassName("tab");
        
        x[previousTab].style.display = "none";
        x[n].style.display = "block";
        previousTab = n;

        
        //alert(x);
      }

  $(document).ready(function(){  

      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><th><input type="text" id="rule_name" name="rule_name[]" class="form-control name-list"></th><td><input type="text" id="responsible" name="responsible[]" class="form-control position-list"></td><td><input type="file" id="rules_documents" name="rules_documents[]" class="form-control branch-list"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-flat btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });   
 });

 function addRules() {
   var k = ""
   var rule_name = document.getElementsByName('rule_name[]'); 
  
            for (var i = 0; i < rule_name.length; i++) { 
                var a = rule_name[i]; 
                k = k + "rule_name[" + i + "].value= " 
                                   + a.value + " "; 
            } 
  
    document.getElementById("rule_name").value = k; 

   var l = ""
   var responsible = document.getElementsByName('responsible[]'); 
  
            for (var i = 0; i < responsible.length; i++) { 
                var a = responsible[i]; 
                l = l + "responsible[" + i + "].value= " 
                                   + a.value + " "; 
            } 
  
    document.getElementById("responsible").value = l; 
    
   var m = ""
   var rules_documents = document.getElementsByName('rules_documents[]'); 
      for (var i = 0; i < responsible.length; i++) { 
          var a = responsible[i]; 
          m = m + "rules_documents[" + i + "].value= " 
                              + a.value + " "; 
      } 
  
    document.getElementById("rules_documents").value = m;

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
    
    document.getElementById("nextBtn").innerHTML = "{{__('msg.Submit to Approval')}}";
    
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
</script>
@endsection