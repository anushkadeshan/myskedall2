@extends('layouts.admin.master')
@section('title', 'PlanOz-Create Roles')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Roles')}}</li>
<li class="breadcrumb-item active">{{__('msg.Create Roles')}}</li>
@endsection

@section('content')

@include('adminlte-templates::common.errors')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <section class="card-header">
                <h1>
                    {{__('msg.Create Roles')}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    {!! Form::open(['route' => 'roles.store']) !!}

                        @include('roles.fields')

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

