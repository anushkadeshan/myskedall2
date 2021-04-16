@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <section class="content-header">
            <h1>
                Alert
            </h1>
        </section>
        <div class="content">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row mt-4" style="padding-left: 20px">
                        @include('alerts.show_fields')
                        <a href="{{ route('alerts.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
