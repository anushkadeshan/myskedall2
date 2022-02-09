@extends('layouts.admin.master')
@section('title', 'Approval Requests')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Approval Requests')}}</li>
@endsection

@section('content')
<div class="px-8 py-8 bg-gray-200">
    <div class="card">
        <div class="card-header">
           <div class="row">
               <div class="col-md-6">
                  <h5>@lang('msg.requests')</h5>
               </div>
               <div class="col-md-6">
                  <a style="float: right;" href="{{route('approvals.create')}}"><button class="btn btn-primary" type="button">Add New</button></a>
              </div>
           </div>
        </div>
        <div class="card-body">
            <livewire:apps.approvals.filters  />
            <livewire:apps.approvals.requests-multiple-actions />
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{asset('assets/admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection

