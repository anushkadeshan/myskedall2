@extends('layouts.admin.master')
@section('title', 'PlanOz-Groups')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Groups')}}</li>
<li class="breadcrumb-item active">{{$group->name}}</li>
@endsection

@section('content')
<div class="container mt-3">

   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="card">
        <section class="card-header">
            <h1>
                Edit {{$group->name}}
            </h1>
       </section>
           <div class="card-body">
               <div class="row">
                   <div class="col-md-12">
                       {!! Form::model($group, ['route' => ['groups.update', $group->id], 'method' => 'patch']) !!}

                        @include('groups.fields')

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

