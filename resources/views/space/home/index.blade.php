@extends('space/template')
@section('content')
<style>
.loader{
  text-align:center;
}
.popup-btn {
    text-align: center;
}
#center-button {
    position: absolute;
    top: 50%;
}
</style>
<div class="modal fade" id="ModelSpaceRequest" tabindex="-1" role="dialog" aria-labelledby="ModelSpaceRequest" aria-hidden="true">
	<div class="modal-dialog" style="top:40%;" role="document" style="width:100%; max-width:500px;">
		<div class="modal-content">
			<div class="modal-body">
				<h4 class="text-center">{{ __('msg.Are you want to reuse this request') }}</h4>
				<div class="justify-content-center">
					<div class="popup-btn">
						<a href="#" class="btn btn-success center-button" id="edit-space-request-attr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('msg.yes') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
						<button class="btn btn-danger ml-2 center-button"  data-dismiss="modal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ __('msg.no') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">

	<h4 class="text-center"> {{ __('msg.Space Control') }}</h4>

	<div class="col-sm-4 col-xs-4">
		<div class="ml-10">
			<a  style="text-decoration: none !important;" href="{{url('space/approved-request')}}"> <img src="{{asset('img/smiling-green.png')}}" style="width:40px;">
				<div class="boxg">{{$requestTotal->approveTotal}}</div>
			</a>
		</div>
	</div>

	<div class="col-sm-4 col-xs-4 centered">
		<div class="ml-10">
			<a  style="text-decoration: none !important;" href="{{url('space/rejected-request')}}" >
				<img src="{{asset('img/confused.png')}}" style="width: 40px;">
				<div class="boxy">{{$requestTotal->rejectedTotal}}</div>
			</a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-4 centered">
		<div class="ml-10">
			<a style="text-decoration: none !important;" href="{{url('space/repproved-request')}}"> <img src="{{asset('img/sad.png')}}" style="width: 40px;">
				<div class="box1">{{$requestTotal->repproveTotal}}</div>
			</a>
		</div>
	</div>
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
		<table id="showSpaceRequests" class="table">
		<thead>
			<tr class="warning">
				<th>{{ __('msg.date') }}</th>
				<th>{{ __('msg.time') }}</th>
				<th>{{ __("msg.events") }}</th>
				<th>{{ __('msg.space') }}</th>
				<th>{{ __('msg.status') }}</th>
				<th>{{ __('msg.edit') }}</th>
			</tr>__
		</thead>
		<tbody>

		</tbody>
	</table>
	</div>
</div>
<div class="row">
	<div class=" container">
		<div class="col-md-12 ">
			<!--div class="col-md-4 col-xs-4">
				<div  id="btn-example-load-more" >{....}</div>
			</div-->
			<div class="col-md-5 col-xs-5 text-right">
				<a data-toggle="modal" data-target="#ReuseRequestConfirm"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size:20px;"></span></a>
			</div>
		</div>
	</div>
</div>

@endsection

