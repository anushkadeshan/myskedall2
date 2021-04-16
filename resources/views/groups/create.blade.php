@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <section class="content-header">
        <h1>
           {{__('msg.Group')}} 
        </h1>
    </section> 
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'groups.store']) !!}

                        @include('groups.fields')

                        {!! Form::close() !!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
