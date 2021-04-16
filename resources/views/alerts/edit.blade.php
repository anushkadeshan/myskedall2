@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-2">
        <section class="content-header">
            <h1>
                Alert
            </h1>
       </section>
       <div class="content">
           @include('adminlte-templates::common.errors')
           <div class="box box-primary">
               <div class="box-body">
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