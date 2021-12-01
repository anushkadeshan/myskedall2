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
            <form action="{{url('admin/get/audit-data')}}" method="post">
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
                <div class="col-md-6 col-sm-6">
                    <h5>Checklist of Return of location used</h5>

                    <div id="location" class="mt-10">

                    @if($location_returned_checklist==null)
                       <font class="text-muted">Please select relevent reservation</font>
                    @else
                    <form action="{{url('admin/get/audit-location-checklist')}}" method="POST">
                        @csrf
                        @php
                            $no = 1;
                        @endphp
                        @foreach($location_returned_checklist as $lrc)
                            <div class="row">
                                <div class="col-sm-10 col-md-10">
                                    <label for="chbf{{$lrc->id}}">@if(session('locale') == 'en'){{$no++}} ). {{$lrc->check_list_en}} @else {{$lrc->check_list_pt}}@endif</label>
                                </div>
                                <input type="hidden" name="request_id" value="{{$lrc->request_id}}">
                                <div class="col-sm-1 col-md-1">
                                    <div class="icheck-success checked disabled">
                                        <input disabled @if($lrc->returned == 1) checked @endif name="checklist[]" id="chbf{{$lrc->id}}"  type="checkbox"  value="{{$lrc->id}}" />
                                        <label for="chbf{{$lrc->id}}"></label>
                                    </div>
                                </div>
                                <div class="col-sm-1 col-md-1">
                                    <div class="icheck-primary">
                                        <input  @if($lrc->audited == 1) checked @endif name="auditL[]" id="auditL{{$lrc->id}}"   type="checkbox"  value="{{$lrc->id}}" />
                                        <label for="auditL{{$lrc->id}}"></label>
                                    </div>
                                </div>
                            </div>
                            <br>

                        @endforeach
                        <button type="submit" class="btn btn-success">{{__('msg.Confirm')}}</button>
                    </form>
                    @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <h5>Checklist of Return of Items used on Location</h5>
                    <div id="checklist" class="mt-10">
                        @if($materials_returned_checklist==null)
                            <font class="text-muted">Please select relevent reservation</font>
                        @else

                        <form action="{{url('admin/get/audit-material-checklist')}}" method="POST">
                            @csrf
                            @php
                                $no2 = 1;
                            @endphp

                            @foreach($materials_returned_checklist as $mrc)
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="chbm{{$mrc->id}}">{{$mrc->material}}</label>
                                    </div>
                                    <input type="hidden" name="request_id" value="{{$mrc->request_id}}">

                                    <div class="col-md-1">
                                        <div class="icheck-success checked disabled">
                                            <input disabled @if($mrc->returned == 1) checked @endif name="checklistM[]" id="chbm{{$mrc->id}}"   type="checkbox"  value="{{$mrc->id}}" />
                                            <label for="chbm{{$mrc->id}}"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="icheck-primary">
                                            <input  @if($mrc->audited == 1) checked @endif name="auditM[]" id="auditM{{$mrc->id}}"   type="checkbox"  value="{{$mrc->id}}" />
                                            <label for="auditM{{$mrc->id}}"></label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">{{__('msg.Confirm')}}</button>
                        </form>
                         @endif
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

@endpush


