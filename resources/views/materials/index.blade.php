@extends('layouts.admin.master')
@section('title', 'PlanOz-Materials')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Materials')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Materials')}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{__('Materials')}}</h1>
                <h1 class="pull-right">
                   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('materials.create') }}">Add New</a>
                </h1>
            </section>
            <div class="card-body">
                    @include('materials.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
