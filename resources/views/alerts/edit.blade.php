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
<li class="breadcrumb-item active">{{__('msg.Edit Alert')}}</li>
@endsection

@section('content')
    <div class="container-fluid pt-4">
        
       <div class="content">
           <div class="card">
                <section class="card-header">
                    <h1>
                        @lang('msg.Alert')
                    </h1>
                </section>
               <div class="card-body">
                   <div class="row">
                       <div class="col-md-12">
                           {!! Form::model($alert, ['route' => ['alerts.update', $alert->id], 'method' => 'patch']) !!}
        
                                @include('alerts.fields')
        
                           {!! Form::close() !!}
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
@endsection