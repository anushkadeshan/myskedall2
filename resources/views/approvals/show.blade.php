@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <br>
    <section class="content-header pt-20">
        <h1>
            Approval
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-top:20px">
                    @include('approvals.show_fields')
                    <a href="{{ route('approvals.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
