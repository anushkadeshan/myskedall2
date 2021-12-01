@extends('layouts.admin.master')
@section('title', 'PlanOz-Users')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" />
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Users')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Users')}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <div class="card-header">
                <h1 class="pull-left">{{__('msg.Users')}} </h1>
                <h1 class="pull-right">
                   <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('users.create') }}">Add New</a>
                </h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('users.table')
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


