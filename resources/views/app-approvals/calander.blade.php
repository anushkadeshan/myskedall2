
@extends('layouts.admin.master')
@section('title', 'Create Levels')

@section('css')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.0.0/main.min.css' rel='stylesheet' />
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Approvals')}}</li>
<li class="breadcrumb-item active">{{__('msg.Calender')}}</li>
@endsection

@section('content')
<livewire:apps.approvals.calender />
@endsection

@section('script')

@endsection
