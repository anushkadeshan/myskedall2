<div class="card mt-4">
    <div class="card-header">
        <div class="col-md-12">
            <h3>@lang('msg.Approval Request') {{$request->id}}</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row m-5 pt-10">
            <div class="col-md-4">
                <h4>@lang('msg.title')</h4>
                <p>{{$request->title}}</p>
            </div>
            <div class="col-md-4">
                <h4>@lang('msg.Group')</h4>
                <p>{{$request->group->name}}</p>
            </div>
            <div class="col-md-4">
                <h4>@lang('msg.type')</h4>
                <p>{{$request->requestType->type}}</p>
            </div>
        </div>
        <div class="row m-5 pt-10">
            <div class="col-md-12">
                <h4>@lang('msg.description')</h4>
                <p>{{$request->description}}</p>
            </div>
        </div>
        <div class="row m-5 pt-10">
            <div class="col-md-2">
                <h4>@lang('msg.due_date')</h4>
                <p>{{$request->due_date}}</p>
            </div>
            <div class="col-md-2">
                <h4>@lang('msg.limit_date')</h4>
                <p>{{$request->limit_date}}</p>
            </div>
            <div class="col-md-2">
                <h4>@lang('msg.limit_date')</h4>
                <p>{{$request->limit_date}}</p>
            </div>
            <div class="col-md-3">
                <h4>@lang('msg.level')</h4>
                <p>
                    {{$request->levels->name}}
                </p>
            </div>
            <div class="col-md-2">
                <h4>@lang('msg.value')</h4>
                <p>{{$request->total_value}}</p>
            </div>
        </div>

        <div class="row pt-10">
            <h3 class="text-success">@lang('msg.requester')</h3>
        </div>
        <div class="row m-5 pt-10">
            <div class="col-md-4">
                <h4>@lang('msg.name')</h4>
                <p>{{$request->requester->name}}</p>
            </div>
            <div class="col-md-4">
                <h4>@lang('msg.phone')</h4>
                <p>{{$request->requester->phone}}</p>
            </div>
            <div class="col-md-4">
                <h4>@lang('msg.Email')</h4>
                <p>{{$request->requester->email}}</p>
            </div>
        </div>
        <div class="row pt-10">
            <h3 class="text-warning">@lang('msg.Approval Status')</h3>
        </div>
        <div class="row m-5 pt-10">
            <div class="col-md-3">
                <h4>@lang('msg.status')</h4>
                <p>
                    @switch($request->current_status)
                        @case(0)
                        <span class="text-warning">
                            {{__('msg.Pending')}}
                        </span>
                        @break
                        @case(1)
                        <span style="color:green">
                            {{__('msg.Approved')}}
                        </span>
                        @break
                        @case(2)
                        <span style="color:purple">
                            {{__('msg.Repproved')}}
                        </span>
                        @break
                        @case(3)
                        <span style="color:blue">
                            {{__('msg.Consulting')}}
                        </span>
                        @break
                    @endswitch
                </p>
            </div>
            @if($request->current_status==1)
            <div class="col-md-3">
                <h4>@lang('msg.approver')</h4>
                <p>{{$request->approvars->name}}</p>
            </div>
            <div class="col-md-3">
                <h4>@lang('msg.Email')</h4>
                <p>{{$request->requester->email}}</p>
            </div>
            <div class="col-md-3">
                <h4>@lang('msg.approved date')</h4>
                <p>{{$request->approved_at}}</p>
            </div>
            @endif
        </div>
    </div>

</div>
