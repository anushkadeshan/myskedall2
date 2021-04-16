@extends('layouts.app')
<style>
    .checked {
        color: orange;
    }
</style>
@section('content')
    <div class="container-fluid mt-3"><section class="content-header">
        <h1 class="pull-left">{{__('msg.Reports - Back Log')}}</h1>
        <h1 class="pull-right">
           
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <h3>Filters</h3>
                <form method="POST" action="">
                @csrf
                <div class="row" style="background-color: #789567; padding:10px ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('msg.Initial Date') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
                            <input required type="text" id="datepicker1" autocomplete="off" name="initial_date" id="initial_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('msg.Initial Time') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
                            {{--<input type="time" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="@if(old('initial_time')){{old('initial_time')}}@elseif(!empty($data->initial_time)){{date('H:i',strtotime($data->initial_time))}}@endif"> --}}
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                <input required type="text" class="form-control" name="initial_time">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{ __('msg.Final Date') }} </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
                            <input required type="text" id="datepicker2" autocomplete="off" class="form-control" name="final_date" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>{{ __('msg.Final Time') }} </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
                            <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                <input required type="text" class="form-control" name="final_time" >
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" ><br>
                            <button type="submit" style="margin-top:5px; " class="btn btn-light"><i class="fa fa-filter"></i> {{__('msg.Filter')}} </button>
                        </div>
                    </div>
                </div>
                </form>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Initial Date</th>
                            <th>Final Date</th>
                            <th>Event</th>
                            <th>Location</th>
                            <th>Requester</th>
                            <th>Check Ok</th>
                            <th>Check Audit</th>
                            <th>Check Not Ok</th>
                            <th>Stars</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backlogs as $backlog)
                            <tr>
                                <td>{{$backlog->initial_date}}</td>
                                <td>{{$backlog->final_date}}</td>
                                <td>{{$backlog->events}}</td>
                                <td>{{$backlog->location}}</td>
                                <td>{{$backlog->location_requester}}</td>
                                <td>
                                    @php
                                        $checkOkM = \DB::table('return_check_list')
                                        ->where('request_id',$backlog->request_id)
                                        ->count();

                                        $checkOkL = \DB::table('requested_materials')
                                        ->where('request_id',$backlog->request_id)
                                        ->count();
                                    @endphp
                                    {{$checkOkM+$checkOkL}}
                                </td>
                                <td>
                                    @php
                                        $checkAuditM = \DB::table('return_check_list')
                                        ->where('request_id',$backlog->request_id)
                                        ->where('audited',1)
                                        ->count();

                                        $checkAuditL = \DB::table('requested_materials')
                                        ->where('request_id',$backlog->request_id)
                                        ->where('audited',1)
                                        ->count();
                                    @endphp
                                    {{$checkAuditM+$checkAuditL}}
                                </td>
                                <td>
                                    @php
                                        $NotOkM = \DB::table('return_check_list')
                                        ->where('request_id',$backlog->request_id)
                                        ->where('audited',0)
                                        ->count();

                                        $NotOkL = \DB::table('requested_materials')
                                        ->where('request_id',$backlog->request_id)
                                        ->where('audited',0)
                                        ->count();
                                    @endphp
                                    {{$NotOkM-$NotOkL}}
                                </td>
                                <td>
                                    @php
                                        $marks = ($checkAuditM+$checkAuditL)/($checkOkM+$checkOkL)*100;
                                    @endphp
                                        @switch ($marks)
                                            @case($marks >= 80)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                
                                            @break
                                            @case($marks >= 50)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                
                                            @break
                                            @case($marks >= 30)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star"></span>
                                                
                                            @break
                                            @case($marks >= 10)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star"></span>
                                                
                                            @break
                                            @case($marks >= 1)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star"></span>
                                                
                                            @break
                                            @default
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star"></span>
                                        @endswitch
                                </td>
                                <td>
                                    <a href="{{url('admin/reports/back-log/item/'.$backlog->id)}}"><button type="button" class="btn btn-warning"><i class="fa fa-eye"></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript"> 
        $('.clockpicker').clockpicker();

        $('#datepicker1').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'yyyy-mm-dd'
		});
		$('#datepicker2').datepicker({
			uiLibrary: 'bootstrap4',
			format: 'yyyy-mm-dd'
		});
    </script>
@endpush
@endsection

