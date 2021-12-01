
@extends('layouts.admin.master')
@section('title', 'Create Levels')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Create Levels')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.create-levels />
@endsection

@section('script')

@endsection
