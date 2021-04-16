@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1 class="pull-left">{{ __('msg.Reason Management') }}</h1>
       
    </section>
    
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                 <hr>
                <form action="{{route('reasons.store')}}" method="post">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.reason') }} </label><strong style="color:red">{{$errors->first('reason')}}</strong>
                                <input type="text" class="form-control" name="reason" value="@if(old('reason')){{old('reason')}}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 ">
                            <input type="submit" style="color:green;font-weight: bold;" value="{{ __('msg.submit') }}">
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