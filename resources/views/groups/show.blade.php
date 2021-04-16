@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <section class="content-header">
        <h1>
          {{__('msg.Groups')}}  
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('groups.show_fields')
                    <a href="{{ route('groups.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
