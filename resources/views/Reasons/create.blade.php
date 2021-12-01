@extends('layouts.admin.master')
@section('title', 'PlanOz-Reason Management')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Reports')}}</li>
<li class="breadcrumb-item active"> {{__('msg.Reason Management')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">


    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{ __('msg.Reason Management') }}</h1>
            </section>
            <div class="card-body">
                <form action="{{route('reasons.store')}}" method="post">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('msg.reason') }} </label><strong style="color:red">{{$errors->first('reason')}}</strong>
                                <input type="text" class="form-control" required name="reason" value="@if(old('reason')){{old('reason')}}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6 mt-10">
                            <input type="submit" class="btn btn-success"  value="{{ __('msg.submit') }}">
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
