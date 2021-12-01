@extends('layouts.admin.master')
@section('title', 'Edit Requests')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Edit Request')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.edit-request :id="$id" />
@endsection

@section('script')

@endsection
