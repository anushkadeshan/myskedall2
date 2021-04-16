@extends('space/template')
@section('content')
<style>
    .loader {
        text-align: center;
    }

    .popup-btn {
        text-align: center;
    }

    #center-button {
        position: absolute;
        top: 50%;
    }

</style>

<div class="row">
    <h4 class="text-center"> {{__('msg.Space Control') }}</h4>
</div>

<div class="row">
    <div class="container">
        <div class="m-5">
            <!--form class="navbar-form navbar-left" role="search"-->
            <div class="navbar-form navbar-left">
                <div class="form-group i-pos">
                    <input type="hidden" id="route-name" value="{{$routename}}">
                    <input type="hidden" id="pageoffset" value="0">
                </div>
                <!--/form-->
            </div>
        </div>
    </div>
</div>

<div class="bs-example">
    <div class="table-responsive">
        <table id="seachSpaceRequests" class="table">
            <thead>
                <tr class="warning">
                    <th>{{ __('msg.date') }}</th>
                    <th>{{ __('msg.time') }}</th>
                    <th>{{ __("msg.events") }}</th>
                    <th>{{ __('msg.space') }}</th>
                    <th>{{ __('msg.status') }}</th>
                    <th>{{ __('msg.view') }}</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>


@endsection

