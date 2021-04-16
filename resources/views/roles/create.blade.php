@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Role
        </h1>
    </section>
    @include('adminlte-templates::common.errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        {!! Form::open(['route' => 'roles.store']) !!}

                            @include('roles.fields')

                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
