@extends('layouts.admin.master')
@section('title', 'PlanOz-All Alerts')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Alerts')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Alerts')}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h3 class="pull-left">{{__('msg.Alerts')}} <span class="badge badge-warning">{{$unread}}</span></h3>
                <h1 class="pull-right">

                </h1>
            </section>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('alerts.table')
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
@endsection
