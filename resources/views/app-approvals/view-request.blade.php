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
<li class="breadcrumb-item active">{{__('msg.View Request')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.view-request :request="$request" />
@endsection

@section('script')

@endsection
