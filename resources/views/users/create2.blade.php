
@extends('layouts.admin.master')
@section('title', 'PlanOz-Create-Users')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Users')}}</li>
<li class="breadcrumb-item active">{{__('msg.Create User')}}</li>
@endsection

@section('content')
<div class="container mt-3">

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="card">
            <div class="card-header">
                <h3>
                    {{__('msg.user')}}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'users.store']) !!}

                            @include('users.fields')

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

