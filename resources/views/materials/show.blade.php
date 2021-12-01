@extends('layouts.admin.master')
@section('title', 'PlanOz-Materials')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Materials')}}</li>
<li class="breadcrumb-item active"> {{$material->material)}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="card">
            <section class="card-header">
                <h1>
                    {{$material->material)}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                    @include('materials.show_fields')
                    <a href="{{ route('materials.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
