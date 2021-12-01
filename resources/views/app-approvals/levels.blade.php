

@extends('layouts.admin.master')
@section('title', 'Approvals - Levels')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Levels')}}</li>
@endsection

@section('content')
<div class="card mt-5">
    <div class="card-header">
       <div class="row">
           <div class="col-md-6">
              <h5>@lang('msg.Levels')</h5>
           </div>
           <div class="col-md-6">
              <a style="float: right;" href="{{route('create.levels')}}"><button class="btn btn-primary" type="button">Add New</button></a>
          </div>
       </div>
    </div>
    <div class="card-body">
        <livewire:apps.approvals.levels />
    </div>
</div>
@endsection

@section('script')

@endsection
