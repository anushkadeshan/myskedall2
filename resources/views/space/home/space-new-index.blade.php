@extends('layouts.admin.master')
@section('title', 'Create Levels')

@section('css')
@endsection

@section('style')
<style>
    .box1 {
        background: #d70101;
        margin-top: 5px;
        width: 40px;
        height: 40px;
        text-align: center;
        vertical-align: middle;
        display: block;
        line-height: 40px;
        color: #fff;
    }

    .boxg {
        background-color: #00d788;
        width: 40px;
        margin-top: 5px;
        height: 40px;
        text-align: center;
        vertical-align: middle;
        display: block;
        line-height: 40px;
        color: #fff;
    }

    .boxy {
        background-color: #fec00e;
        width: 40px;
        margin-top: 5px;
        height: 40px;
        text-align: center;
        vertical-align: middle;
        display: block;
        line-height: 40px;
        color: #fff;
    }
</style>
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">{{__('msg.space')}}</li>
<li class="breadcrumb-item active">{{__('msg.Home')}}</li>
@endsection

@section('content')

<div class="p-3 pt-6">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4> {{ __('msg.Space Control') }}</h4>
                </div>
                <div class="col-md-6">
                    <button style="float: right;"  class="btn btn-danger" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#ReuseRequestConfirm" data-bs-original-title="" title="">Add New</button>
               </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row ">
                <div class="col-sm-4 col-xs-4">
                    <div class="ml-10 text-center">
                        <a style="text-decoration: none !important;" href="{{url('space/approved-request')}}"> <img
                                src="{{asset('img/smiling-green.png')}}" style="width:40px;">
                            <div class="boxg">{{$requestTotal->approveTotal}}</div>
                        </a>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-4 " >
                    <div class="ml-10 text-center">
                        <a style="text-decoration: none !important;" href="{{url('space/rejected-request')}}">
                            <img src="{{asset('img/confused.png')}}" style="width: 40px;">
                            <div class="boxy">{{$requestTotal->rejectedTotal}}</div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4 ">
                    <div class="ml-10 text-center" style="text-align: center;">
                        <a style="text-decoration: none !important;" href="{{url('space/repproved-request')}}"> <img
                                src="{{asset('img/sad.png')}}" style="width: 40px;">
                            <div class="box1">{{$requestTotal->repproveTotal}}</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5">
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
            <div class="bs-example">
                <div class="table-responsive">
                    <table id="showSpaceRequests" class="table">
                    <thead>
                        <tr class="warning">
                            <th>{{ __('msg.date') }}</th>
                            <th>{{ __('msg.time') }}</th>
                            <th>{{ __("msg.events") }}</th>
                            <th>{{ __('msg.space') }}</th>
                            <th>{{ __('msg.status') }}</th>
                            <th>{{ __('msg.edit') }}</th>
                        </tr>
                    </thead>
                    <tbody>
            
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Reuse request confirm Model-->
<div class="modal fade" id="ReuseRequestConfirm" role="dialog">
    <div class="modal-dialog modal-sm" style="top:30%">
    <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">{{ __('msg.Request Option') }}</h4>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>{{ __('msg.Are you want to reuse request') }}</p>
        </div>
        <div class="modal-footer">
          <a  onclick="OpenRequestModel()" class="btn btn-primary float-left" >{{ __('msg.yes') }}</a>
          <a href="{{url('space/new-request')}}" class="btn btn-default">{{ __('msg.no') }}</a>
        </div>
      </div>

    </div>
  </div>
</div>
<!--Reuse Requests table modal-->
<div class="modal fade" id="ModelShowRequest" role="dialog">
    <div class="modal-dialog">
			<div class="modal-content">
			<div class="table-responsive">
			<table id="showRequestInPopup" class="table">
			<thead>
				<tr class="warning">
					<th></th>
					<th>{{ __('msg.date') }}</th>
					<th>{{ __('msg.time') }}</th>
					<th>{{ __('msg.events') }}</th>
					<th>{{ __('msg.space') }}</th>
					<th>{{ __('msg.status') }}</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		</div>
		</div>
    </div>
  </div>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('script')
@endsection