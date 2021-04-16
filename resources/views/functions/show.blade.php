@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1>
            Function
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                        @include('functions.show_fields')
                        <a href="{{ route('functions.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
