@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
    <br>
        <h1 class="pull-left">Approvals</h1>
    <br>
    </section>
    <br>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('approvals.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@endsection

