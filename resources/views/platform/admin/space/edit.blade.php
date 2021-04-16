@extends('platform/template')
@section('content')
<table width="100%" class="painelNivel">
  <tbody><tr><td>Request Management</td></tr>
  <tr><td style="font-size:2px; padding:0px; background-color:#999999">&nbsp;</td></tr>
</tbody></table>
<div class="row">
	<form action="{{route('space.update',$data->id)}}" method="POST">
		@csrf
		{{ method_field('POST') }}
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.events') }} </label><strong style="color:red">{{$errors->first('events')}}</strong>
					<input type="text" class="form-control" name="events" value="{{$data->events}}">
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.No of people') }} </label><strong style="color:red">{{$errors->first('total_people')}}</strong>
					<input type="text" class="form-control" name="total_people" value="{{$data->total_people}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Select Reason') }} </label><strong style="color:red">{{$errors->first('reason')}}</strong>
					<input type="text" class="form-control" name="reason" value="{{$data->reason}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.price') }} </label><strong style="color:red">{{$errors->first('price')}}</strong>
					<input type="text" class="form-control" name="price" value="{{$data->price}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">	
				<div class="form-group">
				    <label>{{__('msg.Initial Date')}} </label><strong style="color:red">{{$errors->first('initial_date')}}</strong>
				    <input type="text" id="datepicker1" autocomplete="off" class="form-control" name="initial_date" value="{{date('Y-m-d',strtotime($data->initial_date))}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Initial Time') }} </label><strong style="color:red">{{$errors->first('initial_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="initial_time" value="{{date('H:i',strtotime($data->initial_time))}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Date') }} </label><strong style="color:red">{{$errors->first('final_date')}}</strong>
					<input type="text" id="datepicker2" autocomplete="off" class="form-control" name="final_date" value="{{date('Y-m-d',strtotime($data->final_date))}}">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>{{ __('msg.Final Time') }} </label><strong style="color:red">{{$errors->first('final_time')}}</strong>
					<input type="text" placeholder="24 Hours" autocomplete="off" class="form-control" name="final_time" value="{{date('H:i',strtotime($data->final_time))}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>User Detail </label><strong style="color:red"></strong>
					<input type="text" class="form-control" disabled value="{{$data->user['name']}}">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<label>{{ __('msg.location') }} </label><strong style="color:red">{{$errors->first('location')}}</strong>
					<textarea class="form-control" name="location">{{$data->location}}</textarea>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 text-center">
				<input type="submit" style="color:green;font-weight: bold;" value="{{ __('msg.Request SPACE') }}">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</form>
</div>
@endsection
