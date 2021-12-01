
@extends('layouts.admin.master')
@section('title', 'Approval Requests')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Create Request')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.create-request />
@endsection

@section('script')

@endsection
