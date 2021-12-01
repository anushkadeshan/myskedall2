
@extends('layouts.admin.master')
@section('title', 'PlanOz-Users')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Users')}}</li>
<li class="breadcrumb-item active">{{$user->name}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="card">
            <section class="card-header">
                <h1>
                    {{$user->name}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                        @include('users.show_fields')
                    </div>

                </div>
                <a href="{{ route('users.index') }}" class="btn btn-primary">{{__('msg.back')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

