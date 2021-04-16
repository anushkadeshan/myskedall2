@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <section class="content-header">
        <h1 class="pull-left">{{ __('msg.group Requests') }}</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('groups.table-requests')
                    </div>
                </div> 
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

