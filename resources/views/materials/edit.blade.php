@extends('layouts.admin.master')
@section('title', 'PlanOz-Materials')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Materials')}}</li>
<li class="breadcrumb-item active">{{$material->material}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3">

   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="card">
        <section class="card-header">
            <h1>
              Edit -  {{$material->material}}
            </h1>
       </section>
           <div class="card-body">
               <div class="row">
                   <div class="col-md-12">
                        {!! Form::model($material, ['route' => ['materials.update', $material->id], 'method' => 'patch']) !!}

                            @include('materials.fields')

                        {!! Form::close() !!}
                   </div>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('script')
@endsection
