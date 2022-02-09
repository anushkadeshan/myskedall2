@extends('layouts.admin.master')
@section('title', 'Space New Request')

@section('css')
@endsection

@section('style')
<style>
    .modal-backdrop.in {
        opacity: 0.9;
    }
    
    .modal-backdrop {
      z-index: 900 !important;
    }
    </style>
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.space')}}</li>
<li class="breadcrumb-item active">{{__('msg.View Requests')}}</li>
@endsection

@section('content')
<div class="container-fluid pt-6">
    <div class="card">
        <section class="card-header pt-20">
            <h1>
                {{__('msg.View Requests')}}
            </h1>
        </section>
        <div class="card-body">
            <div class="row" style="padding-left: 20px; padding-top:20px">
                @include('approvals.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection
