@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3"><section class="content-header">
        <h1 class="pull-left">{{__('msg.Alerts')}} <span class="badge badge-warning">{{$unread}}</span></h1>
        <h1 class="pull-right">
           
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
                        @include('alerts.table')
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div></div>
@endsection

