@extends('layouts.admin.master')
@section('title', 'PlanOz-Type of Location')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.location')}}</li>
<li class="breadcrumb-item active"> {{__('msg.type of Location')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3 pt-6">
    

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{ __('msg.type of Location') }}</h1>
        
            </section>
            <div class="card-body">
                <form action="{{route('types.update',['id'=>$data->id])}}" method="post">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.Location Type') }} </label><strong style="color:red">{{$errors->first('location_type')}}</strong>
                                {{--<input type="text" required class="form-control" name="location_type" value="@if(old('location_type')){{old('location_type')}}@elseif(!empty($data->location_type)){{$data->location_type}}@endif">--}}
                                <input type="text" required class="form-control" name="location_type" value="@if(old('location_type')){{old('location_type')}}@elseif(!empty($data->location_type)){{$data->location_type}}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6 mt-6">
                            <input type="submit" class="btn btn-success" value="{{ __('msg.submit') }}">
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

@push('js')

@endpush

