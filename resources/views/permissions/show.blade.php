@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <section class="content-header">
        <h1>
            Permission
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                        @include('permissions.show_fields')
                        <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
