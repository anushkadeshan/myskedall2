@extends('layouts.admin.master')
@section('title', 'PlanOz-Materials')

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
<li class="breadcrumb-item">{{__('msg.Materials')}}</li>
<li class="breadcrumb-item active">{{__('msg.All Materials')}}</li>
@endsection

@section('content')
<div class="container-fluid mt-3 pt-6">

    <div class="content">
        <div class="clearfix"></div>
    
        <div class="clearfix"></div>
        <div class="card">
            <section class="card-header">
                <h1 class="pull-left">{{__('Materials')}}</h1>
                <h1 class="pull-right">
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter" data-bs-original-title="" title="">@lang('msg.Add New')</button>
                </h1>
            </section>
            <div class="card-body">
                <livewire:materials.table />
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

</div>

<livewire:materials.form />
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