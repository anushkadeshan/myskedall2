@extends('layouts.admin.master')
@section('title', 'Approvals - Support')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Support')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.supports />
@endsection

@section('script')

@endsection
