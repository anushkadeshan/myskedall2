@extends('layouts.admin.master')
@section('title', 'PlanOz-Reports')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" />
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Reports')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Reports - Check Lists')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')
    <div class="clearfix"></div>
    <div class="card">
        <section class="card-header">
            <h1 class="pull-left">{{__('msg.Reports - Check Lists')}}</h1>

            <h1 class="pull-right">

            </h1>
        </section>
        <div class="card-body">
            <form action="{{url('admin/get/checklist-data')}}" method="post">
            <div class="row" style="background-color: #789567; padding:10px ">
                @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('msg.Select Reservation') }} </label>
                        <select name="request_id" id="request_id" class="form-control" onchange="this.form.submit()">
                            <option value="">Select a Reservation</option>
                            @foreach($reservations as $reservation)
                                <option value="{{$reservation->request_id}}">{{$reservation->events}} | {{$reservation->location}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            </form>
            <div class="row mt-5">
                <div class="col-md-6">
                    <h5>Checklist of Return of location used</h5>

                    <div id="location" class="mt-10">
                    @if($location_returned_checklist==null)
                       <font class="text-muted">Please select relevent reservation</font>
                    @else
                    <form action="{{url('admin/get/update-location-checklist')}}" method="POST">
                        @csrf
                        @php
                            $no = 1;
                        @endphp
                        @foreach($location_returned_checklist as $lrc)
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="chbf{{$lrc->id}}">@if(session('locale') == 'en'){{$no++}} ). {{$lrc->check_list_en}} @else {{$lrc->check_list_pt}}@endif</label>
                                </div>
                                <input type="hidden" name="request_id" value="{{$lrc->request_id}}">
                                <div class="col-md-2">

                                    <button id="reason-button{{$lrc->id}}" style="@if($lrc->returned == 1) display:none @endif" onclick="openModalApps({{$lrc->id}})" type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                                </div>
                                <div class="col-md-1">
                                    <div class="icheck-success icheck-inline">
                                        <input @if($lrc->returned == 1) checked @endif name="checklist[]" id="chbf{{$lrc->id}}" onclick="changecheckList(this,{{$lrc->id}})"  type="checkbox"  value="{{$lrc->id}}" />
                                        <label for="chbf{{$lrc->id}}"></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal fade" id="ModalApps{{$lrc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Reason for not proper returning')}} </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="reason" id="reason{{$lrc->id}}" class="form-control" rows="6">{{$lrc->reason}}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}} </button>
                                            @csrf
                                            <button type="button" onclick="updateReason({{$lrc->id}},{{$lrc->request_id}})" class="btn btn-primary">{{__('msg.Update Changes')}} </button>                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <button type="submit" class="btn btn-success">{{__('msg.Confirm')}}</button>
                    </form>
                    @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <h5>Checklist of Return of Items used on Location</h5>
                    <div id="checklist" class="mt-10">
                        <form action="{{url('admin/get/update-material-checklist')}}" method="POST">
                        @csrf
                        @php
                            $no2 = 1;
                        @endphp
                        @if($materials_returned_checklist!==null)
                        @foreach($materials_returned_checklist as $mrc)
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="chbm{{$mrc->id}}">@if(session('locale') == 'en'){{$no2++}} ). {{$mrc->material}} @else {{$mrc->material}}@endif</label>
                                </div>
                                <input type="hidden" name="request_id" value="{{$mrc->request_id}}">
                                <div class="col-md-2">

                                    <button id="reason-button2{{$mrc->id}}" style="@if($mrc->returned == 1) display:none @endif" onclick="openModalMats({{$mrc->id}})" type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                                </div>
                                <div class="col-md-1">
                                    <div class="icheck-success icheck-inline">
                                        <input @if($mrc->returned == 1) checked @endif name="checklistM[]" id="chbm{{$mrc->id}}" onclick="changecheckList2(this,{{$mrc->id}})"  type="checkbox"  value="{{$mrc->id}}" />
                                        <label for="chbm{{$mrc->id}}"></label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal fade" id="ModalMat{{$mrc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">{{__('msg.Reason for not returning material')}} </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="reasonM" id="reasonM{{$mrc->id}}" class="form-control" rows="6">{{$mrc->reason}}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('msg.close')}} </button>
                                            @csrf
                                            <button type="button" onclick="updateReason2({{$mrc->id}},{{$mrc->request_id}})" class="btn btn-primary">{{__('msg.Update Changes')}} </button>                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                         <button type="submit" class="btn btn-success">{{__('msg.Confirm')}}</button>
                         @else
                         <font class="text-muted">Please select relevent reservation</font>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
@endsection
@section('script')
@endsection

@push('js')
<script type="text/javascript">
    function openModalApps(id) {
        $('#ModalApps'+id).modal('show');
    }

    function openModalMats(id) {
        $('#ModalMat'+id).modal('show');
    }
    function changecheckList(a,id) {
        var value   = a.checked;
        if (value===true) {
            $('#reason-button'+id).hide();
        } else {
            $('#reason-button'+id).show();
        }
    }
    function changecheckList2(a,id) {
        var value   = a.checked;
        if (value===true) {
            $('#reason-button2'+id).hide();
        } else {
            $('#reason-button2'+id).show();
        }
    }
    function updateReason(check_id,req_id) {
        var reason = $("#reason"+check_id).val();
        $.ajax({
				type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url: BaseUrl+'/admin/reports/update-reason',
				dataType: "json",
				data:{
					'check_id':check_id,
					'req_id':req_id,
                    'reason':reason
				},
				success: function(response) {
                    $('#ModalApps'+check_id).modal('hide');
                    alert('Updated');

				}
			});
    }

    function updateReason2(check_id,req_id) {
        var reason = $("#reasonM"+check_id).val();
        $.ajax({
				type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				url: BaseUrl+'/admin/reports/update-reason-material',
				dataType: "json",
				data:{
					'check_id':check_id,
					'req_id':req_id,
                    'reason':reason
				},
				success: function(response) {
                    $('#ModalMat'+check_id).modal('hide');
                    alert('Updated');

				}
			});
    }
    </script>
@endpush

