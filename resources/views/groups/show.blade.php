@extends('layouts.admin.master')
@section('title', 'PlanOz-Groups')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Groups')}}</li>
<li class="breadcrumb-item active">{{$group->name}}</li>
@endsection

@section('content')

<div class="container mt-3">

    <div class="content">
        <div class="card">
            <section class="card-header">
                <h1>
                    {{$group->name}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    @include('groups.show_fields')
                    <a href="{{ route('groups.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

