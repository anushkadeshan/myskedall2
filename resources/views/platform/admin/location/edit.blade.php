@extends('layouts.admin.master')
@section('title', 'PlanOz-Type of Location')

@section('css')
@endsection

@section('style')
<style>
  /* Style the form */
  #regForm {
  background-color: #ffffff;
  margin: 10px auto;
  padding: 40px;
  width: 80%;
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
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.location')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Location Management')}}</li>
@endsection
@section('content')
<form id="regForm" action="{{url('admin/edit-location/'.$data->id)}}?" method="POST" enctype="multipart/form-data">
<div id="view">
    <div class="tab">
        <h3 class="text-center">{{__('msg.Location Details')}} </h3>
        {{__('msg.name')}} :
        <p><input value="{{$data->name}}" placeholder="Name" name="name" type="text" oninput="this.className = ''"></p>
        {{__('msg.Address')}} :
        <p><input value="{{$data->address}}" placeholder="Address" name="address" type="text" oninput="this.className = ''"></p>
        {{__('msg.Contact Person')}} :
        <p><input value="{{$data->contact}}" placeholder="Name of Contact Person" name="contact" type="text" oninput="this.className = ''"></p>
        {{__('msg.Telephone')}} :
        <p><input value="{{$data->telephone}}" placeholder="Telephone" name="telephone" type="text" oninput="this.className = ''"></p>
        {{__('msg.Quantity of People')}} :
        <p><input value="{{$data->quantity}}" placeholder="Quantity" type="text" name="quantity" oninput="this.className = ''"></p>
        {{__('msg.Location Type')}} :
        <p>
          <select name="location_type" id="" oninput="this.className = ''">
            @foreach($locationTypes as $type)
            <option value="{{$type->location_type}}">{{$type->location_type}}</option>
            @endforeach
          </select>
        </p>
        {{__('msg.Period')}} :
        <p><input value="{{$data->period}}" placeholder="Period" type="text" name="period" oninput="this.className = ''"></p>
        {{__('msg.Size')}} :
        <p><input value="{{$data->size}}" placeholder="Size should be in Feets" type="text" name="size" oninput="this.className = ''"></p>
        {{__('msg.Area Type')}} :
        <p>
        <select name="area_type" oninput="this.className = ''">
            <option @if($data->area_type=='Covered') selected @endif>Covered</option>
            <option @if($data->area_type=='Uncovered') selected @endif>Uncovered</option>
        </select>
    </div>
    <div class="tab">
        <h3 class="text-center">{{__('msg.Location Details')}} </h3>
        {{__('msg.Air Conditionar')}} :
        <p>
        <select name="air_conditioner" oninput="this.className = ''">
            <option @if($data->air_conditioner=='Yes') selected @endif>Yes</option>
            <option @if($data->air_conditioner=='No') selected @endif>No</option>
        </select>
        </p>
        {{__('msg.Total People')}} :
        <p><input value="{{$data->total_people}}" placeholder="Total People" name="total_people" type="number" oninput="this.className = ''"></p>
        {{__('msg.Total Chair')}} :
        <p><input value="{{$data->total_chair}}" placeholder="Total Chair" name="total_chair" type="number" oninput="this.className = ''"></p>
        {{__('msg.Total Table')}} 
        <p><input value="{{$data->total_table}}" placeholder="Total Table" name="total_table" type="number" oninput="this.className = ''"></p>
        {{__('msg.Parking')}} 
        <p>
        <select name="parking" oninput="this.className = ''">
            <option @if($data->parking=='Yes') selected @endif>Yes</option>
            <option @if($data->parking=='No') selected @endif>No</option>
        </select>
        </p>
        {{__('msg.Price')}} :
        <p><input value="{{$data->price}}" placeholder="Price" name="price" type="number" oninput="this.className = ''"></p>
        {{__('msg.Budget')}} :
        <p><input value="{{$data->budget}}" placeholder="Budget" name="budget" type="number" oninput="this.className = ''"></p>
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
        @can('Edit Location')
        <div class="mt-10 text-center" style="margin-top: 10px;">
            <button onclick="skethEdit({{$data->id}})" type="button" class="btn btn-success">{{__('msg.Edit')}}  <i class="fa fa-edit"></i></button>
        </div>
        
        @endcan
        
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
        @can('Edit Location')
        <div class="mt-10 text-center" style="margin-top: 10px;">
            <button onclick="bluePrintEdit({{$data->id}})" type="button" class="btn btn-success">Edit <i class="fa fa-edit"></i></button>
        </div>
        
        @endcan
    </div>
    <div class="tab"><h3 class="text-center">{{__('msg.Items')}}</h3> :
        <p><strong>{{__('msg.Metirial Resources')}}</strong>
          @foreach($materials as $material)
            <div class="row">
                <div class="col-md-10">
                <div class="icheck-primary icheck-inline">                         
                    <input id="chb{{$material->id}}" @if(in_array($material->id, $selected_materials) ) checked @endif type="checkbox" value="{{$material->id}}" onclick="showQuantity(this,{{$material->id}})" name="materials[]" />
                    <label for="chb{{$material->id}}">{{$material->material}}</label>
                    </div>
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
                    $maxm = $material->quantity - $material->allocated;
                @endphp
                <input type="number" @if(!in_array($material->id, $selected_materials) ) disabled @endif  id="qty{{$material->id}}" name="m_quantity[]" max="{{$maxm}}" min="0" value="{{$m_quantity}}" class="form-control">
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
                <input id="chbf{{$function->id}}"  @if(in_array($function->id, $selected_functions) ) checked @endif type="checkbox" value="{{$function->id}}" onclick="showQuantityF(this,{{$function->id}})" name="functions[]" />
                <label for="chbf{{$function->id}}">{{$function->professional}}</label>
                </div>
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
                    $maxf = $function->quantity - $function->allocated;
                @endphp
              <input type="number" @if(!in_array($function->id, $selected_functions) ) disabled @endif min="0" id="qtyF{{$function->id}}" name="f_quantity[]" max="{{$maxf}}" value="{{$f_quantity}}" class="form-control">
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
        @can('Edit Location')
        <div class="mt-10 text-center" style="margin-top: 10px;">
            <button onclick="RulesEdit({{$data->id}})" type="button" class="btn btn-success">Edit <i class="fa fa-edit"></i></button>
        </div>
        
        @endcan
        {{__('msg.Notes')}} :
            <p>
                <textarea  name="notes" placeholder="Write your Notes Here" oninput="this.className = ''">{{$data->notes}}</textarea>
            </p>
    </div>

    <div style="overflow:auto; margin-top:10px;">
        <div style="float:right;">
            <button type="button" id="prevBtn" class="btn btn-outline-primary"  onclick="nextPrev(-1)"><i class="fa fa-chevron-circle-left"></i> Previous </button>
            <button type="button" id="nextBtn" class="btn btn-outline-success"  onclick="nextPrev(1)">Next <i class="fa fa-chevron-circle-right"></i></button>
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
    
</form>

@can('Edit Location')
<!-- Models -->
<!-- Modal -->
    <div class="modal fade" id="sketchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Edit Photos and Sketchs of')}}  {{$data->name}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if($data->photos != "")
                            @foreach(explode(',', $data->photos) as $info) 
                                @if(preg_match('/(\.jpg|\.png|\.bmp|\.jpeg|\.JPG|\.PNG)$/i',$info)) 
                                    <div id="{{$info}}" class="col-md-4">
                                        <div class="thumbnail">
                                            <div class="img-wrap">
                                                <a onclick="deletePhoto({{$data->id}},'{{$info}}')"><span class="close">&times;</span></a>
                                                    <img  src="{{asset('_dados/plataforma/location/images/'.$info)}}" style="width:100%">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif 
                    </div>
                    @if($data->sketch != "")
                        @foreach(explode(',', $data->sketch) as $info)
                            @if(preg_match('/(\.pdf|\.doc|\.docx|\.csv|\.xlsx)$/i',$info))  
                               <div id="{{$info}}"><a href="{{asset('_dados/plataforma/location/sketch/'.$info)}}">
                                <img style="margin-bottom: 5px;" src="{{asset('img/document.png')}}" alt="">
                                    {{$info}}
                                </a> 
                                <a  style="cursor: pointer" onclick="deleteFile({{$data->id}},'{{$info}}')"><i class="fa fa-close"></i></a></div>
                            @endif
                        @endforeach
                    @endif
                    <br>
                    <form action="{{url('admin/new-location-sketchs')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col md 6">
                                <div class="form-group">
                                    <label for="">{{__('msg.Add New Photos')}} </label>
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <input type="file" name="photos[]" multiple class="form-control">
                                </div>
                            </div>
                            <div class="col md 6">
                                <div class="form-group">
                                    <label for="">{{__('msg.Add New Sketchs')}} (Accept: pdf/doc/xlsx/csv)</label>
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <input type="file" name="sketch[]" multiple class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}} </button>
                    <button type="submit" class="btn btn-primary">{{__('msg.Upload Files')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bluePrintModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Edit Blue Prints of')}}  {{$data->name}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if($data->blue_print != "")
                            @foreach(explode(',', $data->blue_print) as $info) 
                                @if(preg_match('/(\.pdf|\.doc|\.docx|\.xlsx)$/i',$info)) 
                                    <div id="{{$info}}" class="col-md-4">
                                        <div class="thumbnail">
                                            <div class="img-wrap">
                                                <a onclick="deleteBluePrint({{$data->id}},'{{$info}}')"><span class="close">&times;</span></a>
                                                    <img  src="{{asset('img/document2.png')}}" style="width:100%">
                                                    <br>
                                            </div>
                                        </div>
                                        <span>{{$info}}</span>
                                    </div>
                                @endif
                            @endforeach
                        @endif 
                    </div>
                    <br>
                    <form action="{{url('admin/new-location-blue-prints')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">{{__('msg.Add New Blue Prints')}} </label>
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="file" name="blue_print[]" multiple class="form-control">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}} </button>
                    <button type="submit" class="btn btn-primary">{{__('msg.Upload Files')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="RulesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Edit Rules of')}}  {{$data->name}}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>{{__('msg.List of Rules')}} </h4>
                    <table class="table table-borderless">
                        <tr>
                            <th></th>
                            <th>{{__('msg.Rule Name')}} </th>
                            <th>{{__('msg.Responsible')}} </th>
                            <th>{{__('msg.Documents')}} </th>
                            <th>{{__('msg.Crerated At')}} </th>
                            <th>{{__('msg.Action')}} </th>
                        </tr>
                        @php
                            $no1=1;
                        @endphp
                        @foreach($rules as $rule)
                            <tr class="rule{{$rule->id}}">
                                <td width="10">{{$no1++}}</td>
                                <td>{{$rule->rule_name}}</td>
                                <td>{{$rule->responsible}}</td>
                                <td><a href="{{asset('_dados/plataforma/location/rules/'.$rule->rules_documents)}}"><img height="24px" src="{{asset('img/document.png')}}" alt=""></a></td>
                                <td>{{$rule->created_at}}</td>
                                <td><i onclick="deleteRule({{$rule->id}},'{{$rule->rules_documents}}')" style="cursor: pointer" class="fa fa-trash"></i></td>
                            </tr>
                        @endforeach
                    </table>
                    <form action="{{url('admin/new-location-rules')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h4>{{__('msg.Add New Rules')}} </h4>
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
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}} </button>
                    <button type="submit" class="btn btn-primary">{{__('msg.Update Rules')}} </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endcan


@endsection
@section('script')

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
    progress = progress + 20
    document.getElementById("progress-bar").innerHTML = progress+"%";
    document.getElementById("progress-bar").style.width = progress+"%";
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