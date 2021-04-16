@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1 class="pull-left">{{__('msg.Groups')}} </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('groups.create') }}">{{__('msg.Add New')}}</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('groups.table')
                    </div>
                </div> 
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

