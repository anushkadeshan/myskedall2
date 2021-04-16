@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <section class="content-header">
        <h1>
            {{__('msg.user')}} 
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['route' => 'users.store']) !!}

                            @include('users.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
