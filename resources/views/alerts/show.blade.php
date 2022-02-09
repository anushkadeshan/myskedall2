@extends('layouts.admin.master')
@section('title', 'PlanOz-All Alerts')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Alerts')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Alerts')}}</li>
@endsection

@section('content')
<div class="container-fluid pt-3">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h3 class="pull-left">{{__('msg.Alerts')}}</h3>
                <h1 class="pull-right">

                </h1>
            </section>
            <div class="card-body">
                <div class="row">
                    @include('alerts.show_fields')
                </div>
                
                <a href="{{ route('alerts.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
