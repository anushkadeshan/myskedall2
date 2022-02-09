@extends('layouts.admin.master')
@section('title', 'PlanOz-Functions')

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
<li class="breadcrumb-item">{{__('msg.Functions')}}</li>
<li class="breadcrumb-item active"> {{__('msg.All Functions')}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3 pt-6">

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{__('msg.Functions')}}</h1>
                <h1 class="pull-right">
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter" data-bs-original-title="" title="">@lang('msg.Add New')</button>
                </h1>
            </section>
            <div class="card-body">
                <livewire:functions.table />
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
    <livewire:functions.form />
</div>
@endsection

@section('script')
<script>
    window.addEventListener('openModal', event => {
        $("#exampleModalCenter").modal('show');
    });

    window.addEventListener('openEditModal', event => {
        $("#exampleModalCenterEdit").modal('show');
    });
  
    window.addEventListener('closeModal', event => {
        $("#exampleModalCenter").modal('hide');
    })

    window.addEventListener('closeEditModal', event => {
        $("#exampleModalCenterEdit").modal('hide');
    })

    window.addEventListener('openViewModal', event => {
        $("#exampleModalCenterView").modal('show');
    })
  </script>
@endsection

