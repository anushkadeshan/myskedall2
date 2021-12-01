@extends('layouts.app')

@section('content')

@endsection
@extends('layouts.admin.master')
@section('title', 'PlanOz-Functions')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.Functions')}}</li>
<li class="breadcrumb-item active"> {{$function->professional}}</li>
@endsection
@section('content')
<div class="container-fluid mt-3">

    <div class="content">
        <div class="card">
            <section class="card-header">
                <h1>
                    {{$function->professional}}
                </h1>
            </section>
            <div class="card-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                        {!! Form::model($function, ['route' => ['functions.update', $function->id], 'method' => 'patch']) !!}

                        @include('functions.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection

