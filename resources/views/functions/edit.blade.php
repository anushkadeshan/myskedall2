@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1>
            Function
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <div class="col-md-12">
                   {!! Form::model($function, ['route' => ['functions.update', $function->id], 'method' => 'patch']) !!}

                        @include('functions.fields')

                   {!! Form::close() !!}
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection