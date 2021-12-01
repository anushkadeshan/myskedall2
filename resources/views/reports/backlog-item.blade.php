@extends('layouts.admin.master')
@section('title', 'PlanOz-Reports')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/timepicker.css')}}">
@endsection

@section('style')
<style>
    .checked {
        color: orange;
    }
</style>
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Reports')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Reports - Back Log')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

<div class="content">
    <div class="clearfix"></div>

    @include('flash::message')
    <div class="clearfix"></div>
    <div class="card">
        <section class="card-header">
            <h1 class="pull-left">{{__('msg.Reports - Back Log')}}</h1>
        </section>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Request Id :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->request_id}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Name of the Event :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->events}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Name of the Location :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->location}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Requester :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->name}}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Manager :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->space_manager}}
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Initial Date and Time :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->initial_date}} : {{$backlog->initial_time}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Final Date and Time :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->final_date}} : {{$backlog->final_time}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Aprover :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->space_manager}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Budget :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->price}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Department :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            {{$backlog->space}}
                        </div>


                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Total Points :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            @php
                                $totalM = \DB::table('return_check_list')
                                ->where('request_id',$backlog->request_id)
                                ->count();

                                $totalL = \DB::table('requested_materials')
                                ->where('request_id',$backlog->request_id)
                                ->count();
                            @endphp
                                {{$totalM+$totalL}}

                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Check List Points :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            @php
                                $checkOkM = \DB::table('return_check_list')
                                ->where('request_id',$backlog->request_id)
                                ->sum('returned');

                                $checkOkL = \DB::table('requested_materials')
                                ->where('request_id',$backlog->request_id)
                                ->sum('returned');
                            @endphp
                                {{$checkOkM+$checkOkL}}

                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Audit Points :</strong>
                        </div>
                        <div class="col-md-6 mb-3">
                            @php
                                    $checkAuditM = \DB::table('return_check_list')
                                    ->where('request_id',$backlog->request_id)
                                    ->where('audited',1)
                                    ->count();

                                    $checkAuditL = \DB::table('requested_materials')
                                    ->where('request_id',$backlog->request_id)
                                    ->where('audited',1)
                                    ->count();
                                @endphp
                                {{$checkAuditM+$checkAuditL}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Budget :</strong>
                        </div>
                        <div class="col-md-6 mb-3">

                             @php

                                $marks = ($checkAuditM+$checkAuditL)/($totalM+$totalL)*100;

                            @endphp
                                @switch ($marks)
                                    @case($marks >= 80)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>

                                    @break
                                    @case($marks >= 50)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>

                                    @break
                                    @case($marks >= 30)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star"></span>

                                    @break
                                    @case($marks >= 10)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star"></span>

                                    @break
                                    @case($marks >= 1)
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star"></span>

                                    @break
                                    @default
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star "></span>
                                        <span class="fa fa-star"></span>
                                @endswitch
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <a href="{{url('admin/reports/back-log')}}"><button type="button" class="btn btn-primary"><i class="fa fa-backward"></i> {{__('msg.back')}}</button></a>
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

