@extends('layouts.admin.master')
@section('title', 'PlanOz-All Permissions')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Permissions')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Permissions')}}</li>
@endsection

@section('content')
<div class="container mt-3">
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{__('msg.Permissions')}} </h1>
                <h1 class="pull-right">
                   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('permissions.create') }}">{{__('msg.Add New')}} </a>
                </h1>
            </section>
            <div class="card-body">
                <div class="row">
                   <div class="col-md-12">
                        @include('permissions.table')
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

@endsection

