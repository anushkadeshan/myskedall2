@extends('layouts.admin.master')
@section('title', 'PlanOz-Reports')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/timepicker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Reports')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Reports - Locations')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')
    <div class="clearfix"></div>
    <div class="card">
        <section class="card-header">
            <h1 class="pull-left">{{__('msg.Reports - Locations')}}</h1>
            <h1 class="pull-right">

            </h1>
        </section>
        <div class="card-body">

            <h5>Filters</h5>
            <form method="POST" action="">
            @csrf
            <div class="row" style="background-color: #789567; padding:10px ">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>{{ __('msg.Initial Date') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
                        <input required type="text" id="datepicker1" autocomplete="off" name="initial_date" id="initial_date" class="datepicker-here form-control digits" data-date-format="yyyy-mm-dd"  data-language="en">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group clockpicker">
                        <label>{{ __('msg.Initial Time') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
                        {{--<input type="time" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="@if(old('initial_time')){{old('initial_time')}}@elseif(!empty($data->initial_time)){{date('H:i',strtotime($data->initial_time))}}@endif"> --}}
                        <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input required type="text" class="form-control" name="initial_time">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group ">
                        <label>{{ __('msg.Final Date') }} </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
                        <input required type="text" id="datepicker2" autocomplete="off" class="datepicker-here form-control digits" name="final_date"  data-date-format="yyyy-mm-dd"  data-language="en">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group clockpicker">
                        <label>{{ __('msg.Final Time') }} </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
                        <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input required type="text" class="form-control" name="final_time" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" ><br>
                        <button type="submit" style="margin-top:5px; " class="btn btn-warning"><i class="fa fa-filter"></i> {{__('msg.Filter')}} </button>
                    </div>
                </div>
            </div>
            </form>

            <br>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <font class="text-dark" style="font-size:15px">{{__('msg.Initial Date')}}  :  <strong>{{$initial_date}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-dark" style="font-size:15px">{{__('msg.Initial Time')}}  :  <strong>{{$initial_time}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-dark" style="font-size:15px">{{__('msg.Final Date')}}  :  <strong>{{$final_date}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-dark" style="font-size:15px">{{__('msg.Final Time')}}  :  <strong>{{$final_time}}</strong></font>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <font class="text-dark" style="font-size:20px">{{__('msg.Total Locations')}}  :  <strong>{{$total_allocated+$total_available+$total_rejected}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-danger" style="font-size:20px">{{__('msg.Locations Allocated')}}  :  <strong>{{$total_allocated}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-success" style="font-size:20px">{{__('msg.Locations Available')}}  :  <strong>{{$total_available}}</strong></font>
                </div>
                <div class="col-md-3 mb-4">
                    <font class="text-warning" style="font-size:20px">{{__('msg.Locations Rejected')}}  :  <strong>{{$total_rejected}}</strong></font>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">

    </div>
</div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/admin/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/admin/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/admin/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/admin/js/time-picker/jquery-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/admin/js/time-picker/highlight.min.js')}}"></script>
<script src="{{asset('assets/admin/js/time-picker/clockpicker.js')}}"></script>
@endsection
