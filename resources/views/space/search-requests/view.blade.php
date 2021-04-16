@extends('space/template')
@section('content')
<div class="row">
    @if($data->is_draft==1)
    <div class="col-md-12 text-right">
        <span class="text-danger" style="padding-right: 20px"><b>Pending</b></span>
    </div>
    @endif
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.events') }} </label> : <span class="text-muted">{{$data->events}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.No of people') }} </label> : <span class="text-muted">{{$data->total_people}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.reason') }} </label> : <span class="text-muted">{{$data->reason}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.price') }} </label> : <span class="text-muted">{{$data->price}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Initial Date') }} </label> : <span class="text-muted">{{$data->initial_date}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Initial Time') }} </label> : <span class="text-muted">{{$data->initial_time}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Final Date') }} </label> : <span class="text-muted">{{$data->final_date}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Final Time') }} </label> : <span class="text-muted">{{$data->final_time}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.location') }} </label> : <span class="text-muted">{{$data->location}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Space Manager') }} </label> : <span class="text-muted">{{$data->space_manager}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.Location Requester') }} </label> : <span class="text-muted">{{$data->location_requester}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ __('msg.status') }} </label> : 
                    @if($data->is_draft==1)
                    <span class="text-primary">Draft</span>
                    @else
                        @switch($data->status)
                        @case(1)
                        <span class="text-danger">Rejected</span>
                        @break

                        @case(2)
                        <span class="text-success">Approved/Reapproved</span>
                        @break

                        @default
                        <span class="text-default">Pending</span>
                        @endswitch

                    @endif
                </div>
            </div>

            
        </div>
    
</div>
@endsection

