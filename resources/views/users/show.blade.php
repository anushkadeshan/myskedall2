@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <section class="content-header">
        <h1>
            {{__('msg.user')}}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <div class="col-md-12">
                        @include('users.show_fields')
                    </div>
                    
                </div>
                <a href="{{ route('users.index') }}" class="btn btn-primary">{{__('msg.back')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection
