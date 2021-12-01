@extends('layouts.admin.master')
@section('title', 'PlanOz-Functions')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Functions')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Create Functions')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card">
            <section class="card-header">
                <h1>
                    {{__('msg.Create Functions')}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route' => 'functions.store']) !!}
                        @include('functions.fields')
                    {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection

